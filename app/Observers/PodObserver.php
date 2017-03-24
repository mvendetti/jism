<?php

namespace App\Observers;

use App\Pod;
use App\Camera;

class PodObserver
{
    protected $pod = null;
    protected $leftChanged = false;
    protected $rightChanged = false;
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function saving(Pod $pod)
    {
        $this->pod = $pod;
        $this->setCameraChanged();
        if($this->eitherSidesChanged())
        {
            $this->clearThisPod();
            $this->clearOtherPods();
            $this->updateEffectedCameras();
        }
    }

    protected function setCameraChanged()
    {
        $this->leftChanged = $this->didCameraChange('left');
        $this->rightChanged = $this->didCameraChange('right');
    }

    protected function didCameraChange($side)
    {
        $field = 'camera_'.$side.'_id';
        return $this->pod->{$field} !== null && $this->pod->{$field} !== $this->pod->getOriginal($field);
    }

    protected function clearThisPod()
    {
        $this->checkPodForCameraConflict();
        $this->checkIfCameraMovedOnPod('left');
        $this->checkIfCameraMovedOnPod('right');
    }

    protected function checkIfCameraMovedOnPod($side)
    {
        $otherSide = $side == 'left'
            ? 'right'
            : 'left';

        if($this->{$side.'Changed'})
        {
            if($this->bothSidesMatch($this->pod))
            {
                $this->pod->{'camera_'.$otherSide.'_id'} = null;
            }
        }
    }

    protected function bothSidesMatch()
    {
        return $this->pod->camera_left_id === $this->pod->camera_right_id;
    }

    protected function bothSidesChanged()
    {
        return $this->leftChanged && $this->rightChanged;
    }

    protected function eitherSidesChanged()
    {
        return $this->leftChanged || $this->rightChanged;
    }

    protected function checkPodForCameraConflict()
    {
        if($this->bothSidesChanged() && $this->bothSidesMatch())
        {
            return abort(409, 'Camera cannot be in both left and right position of pod');
        }
        return true;
    }

    protected function clearOtherPods()
    {
        if($this->eitherSidesChanged())
        {
            $pods = Pod::where('id', '!=', $this->pod->id)->get();

            $pods->each(function($pod) { $this->removeCamerasFromRemotePod($pod); });
        }
    }

    protected function removeCamerasFromRemotePod($pod)
    {
        if($this->leftChanged)
        {
            $this->removeCameraFromRemotePod($pod, $this->pod->camera_left_id);
        }
        if($this->rightChanged)
        {
            $this->removeCameraFromRemotePod($pod, $this->pod->camera_right_id);
        }
    }

    protected function removeCameraFromRemotePod($pod, $serial_number)
    {
        if($pod->camera_left_id === $serial_number)
        {
            $pod->camera_left_id = null;
        }
        if($pod->camera_right_id === $serial_number)
        {
            $pod->camera_right_id = null;
        }
        $pod->save();
    }

    protected function updateEffectedCameras()
    {
        if($this->leftChanged && $this->pod->camera_left->pod_id !== $this->pod->id)
        {
            $this->pod->camera_left->pod_id = $this->pod->id;
            $this->pod->camera_left->save();
        }
        if($this->rightChanged && $this->pod->camera_right->pod_id !== $this->pod->id)
        {
            $this->pod->camera_right->pod_id = $this->pod->id;
            $this->pod->camera_right->save();
        }
    }
}
/*


$p = App\Pod::find(3);
$c = App\Camera::where('serial_number', 'C3121126510486')->first();
$p->camera_left()->associate($c);

$p->save();
















 */

<?php

namespace Marshmallow\GTMetrix\Actions;

use Exception;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Comodolab\Nova\Fields\Help\Help;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Marshmallow\GTMetrix\Facades\GTMetrix;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckGTMetrixScore extends Action implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The displayable name of the action.
     *
     * @var string
     */
    public $name = 'Get GTmetrix score';

    /**
     * Indicates if this action is only available on the resource detail view.
     *
     * @var bool
     */
    public $onlyOnDetail = true;

    /**
     * The text to be used for the action's confirm button.
     *
     * @var string
     */
    public $confirmButtonText = 'Get the score';

    /**
     * The text to be used for the action's confirmation text.
     *
     * @var string
     */
    public $confirmText = 'Are you sure you want to run this action?';


    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            try {
                GTMetrix::getScore($model);
                $this->markAsFinished($model);
            } catch (Exception $e) {
                $this->markAsFailed($model, $e);
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $points = GTMetrix::getCredits();
        $text = 'You have '. $points .' credits remaining on you GTmedrix account. This action will cost you 1 credit. ';
        if ($points < 20) {
            $text .= 'Your account will be restored to 20 credits at ' . GTMetrix::getCreditRefillDate() . '. ';
        }
        $text .= 'Are you sure you want to continue?';

        return [
            Help::make('GT Metrix credit information', $text),
        ];
    }
}

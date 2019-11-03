<?php

namespace App\Listeners;

use Illuminate\Support\Str;
use App\Events\OperasionalRollbackEvent;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OperasionalRollbackListener
{
    private $model;
    private $tableName;
    private $namespace = 'App\\Models\\Operasional\\';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getModelName($table)
    {
        $class = Str::studly(Str::singular($table));
<<<<<<< HEAD
        
        if (! is_null($class)) {

            if (is_subclass_of($this->namespace.$class, 'Illuminate\Database\Eloquent\Model')) {
                
                $model = $this->namespace . $class;

            } elseif (is_subclass_of($this->namespace.'Dokumen\\'.$class, 'Illuminate\Database\Eloquent\Model')) {

                $model = $this->namespace . 'Dokumen\\' . $class;

            } else {
                return false;
            }

=======

        if (! is_null($class)) {

            if (! is_subclass_of($this->namespace . $class, 'Illuminate\Database\Eloquent\Model')) {

                 return false;

            }

            $model = $this->namespace . $class;

>>>>>>> 67c29aeccc0c7a28f91b3071026904c840692a41
            $operasionalClass = new $model;

            return $this->model = $operasionalClass->getTable() == $this->tableName 
                                ? $operasionalClass 
                                : false;

        }

        return false;
    }

    /**
     * Handle the event.
     *
     * @param  OperasionalRollbackEvent  $event
     * @return void
     */
    public function handle(OperasionalRollbackEvent $event)
    {
        $this->tableName    = $event->type;

<<<<<<< HEAD
        if ($this->getModelName($this->tableName)) {
=======
        if ( $this->getModelName($this->tableName) ) {
>>>>>>> 67c29aeccc0c7a28f91b3071026904c840692a41

            $operasional    =   $this->model->whereIn('bulan', [$event->bulan])
                                            ->whereIn('wilker_id', [$event->wilkerId])
                                            ->get();
                                            
            $operasional->each(function($item, $key){

                return $item->delete();

            });

        } else {

            throw new ModelNotFoundException(); 
        }

    }
}

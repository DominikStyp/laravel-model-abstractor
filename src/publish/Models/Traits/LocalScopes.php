<?php
namespace App\Models\Traits;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Dominik
 */
trait LocalScopes {
    
    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewest(\Illuminate\Database\Eloquent\Builder $builder)
    {
        return $builder->orderBy("id","desc");
    }
    
    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOldest(\Illuminate\Database\Eloquent\Builder $builder)
    {
        return $builder->orderBy("id","asc");
    }
}

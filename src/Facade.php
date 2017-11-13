<?php

namespace DominikStyp\LaravelModelAbstractor;

/**
 * Facade
 *
 * @author Dominik
 */
class LarModAbs {
    public static function test() {
        $model1 = new \App\Dummy1();
        $model2 = new \App\Dummy2();
        $model3 = new \App\Dummy3();
        exit(__METHOD__);
    }
}

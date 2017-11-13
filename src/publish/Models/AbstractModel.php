<?php
namespace App\Models;

/**
 * AbstractModel
 *
 * @author Dominik
 */
abstract class AbstractModel extends \Illuminate\Database\Eloquent\Model {
    use Traits\LocalScopes;
}

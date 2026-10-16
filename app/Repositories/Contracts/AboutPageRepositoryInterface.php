<?php

namespace App\Repositories\Contracts;

use App\Models\AboutPage;

interface AboutPageRepositoryInterface
{
    public function find(): AboutPage ;
    

    public function update(array $data): AboutPage ;
}

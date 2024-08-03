<?php

namespace App\Repository\Dashboard;

Interface PostRepositoryInterface {

    public function all();
    public function show($id);
    public function toggleStatus($id);
    public function destroy($id);
}

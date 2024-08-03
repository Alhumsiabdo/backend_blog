<?php

namespace App\Repository\Dashboard;

Interface CommentRepositoryInterface {
    public function show($post);
    public function destroy($id);
}

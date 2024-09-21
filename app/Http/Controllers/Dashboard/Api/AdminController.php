<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Repository\Dashboard\AdminRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $admins = $this->adminRepository->all();
        return ApiResponse::success($admins);
    }

    public function show($id)
    {
        $admin = $this->adminRepository->find($id);
        if ($admin) {
            return ApiResponse::success($admin);
        }
        return ApiResponse::error("Admin not found.", [], 404);
    }

    public function store(StoreAdminRequest $storeAdminRequest)
    {
        $data = $storeAdminRequest->validated();
        $admin = $this->adminRepository->create($data);
        return ApiResponse::success($admin, "Admin Created Successfully.");
    }

    public function update($id, UpdateAdminRequest $updateAdminRequest)
    {
        $data = $updateAdminRequest->validated();
        $admin = $this->adminRepository->update($id, $data);
        if ($admin) {
            return ApiResponse::success($admin, "Admin Updated Successfully.");
        }
        return ApiResponse::error("Admin not found.", [], 404);
    }

    public function destroy($id)
    {
        $deleted = $this->adminRepository->delete($id);

        if ($deleted) {
            return ApiResponse::success($deleted, "Admin deleted successfully.", 200);
        }

        return ApiResponse::error("Admin not found.", [], 404);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\OrganizationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class OrganizationController extends Controller 
{
    protected $organizationRepository;
    public function __construct(OrganizationRepositoryInterface $organizationRepository){
        $this->organizationRepository = $organizationRepository;
    }
    public function index(Request $request){
        $organizations = $this->organizationRepository->index();
        return view('dashboard.organization.index', compact('organizations')) ;
    }
    
}

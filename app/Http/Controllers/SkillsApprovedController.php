<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SkillsApprovedRepository;


class SkillsApprovedController extends Controller
{
    protected $skillApprovedRepository;

    public function __construct(SkillsApprovedRepository $skillApprovedRepository)
    {
        $this->skillApprovedRepository = $skillApprovedRepository;
    }

    public function index()
    {
        // return view('skills_approved.index');
    }
}

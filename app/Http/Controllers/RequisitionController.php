<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Notification;

class RequisitionController extends Controller
{
    public function index()
    {
        return view('requests.index');
    }

    public function create() {
        return view('requests.create');
    }

    public function store(Request $request) {
        $request->validate([
            'destination' => ['required', 'string', 'max:255'], 
            'client' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string', 'max:255'],
            'travel_mode' => ['required', 'max:255'],
            'accommodation' => ['required', 'max:255'],
            'trip_date' => ['required', 'date'],
        ]);
        
        $trip_date = date_create($request->input('trip_date'));

        $requisition = new Requisition(
            [
                'destination' => $request->input('destination'),
                'client' => $request->input('client'),
                'reason' => $request->input('reason'),
                'travel_mode' => $request->input('travel_mode'),
                'accommodation' => $request->input('accommodation'),
                'trip_date' => $trip_date,
                'user_id' => auth()->id(),
                'department_id' => auth()->user()->department_id,
            ]
        );
        $requisition->save();

        $users = User::where('department_id', auth()->user()->department_id)->get();
        foreach($users as $user) {
            if($user->hasRole('hod-agm-gm')) {
                $hod = $user->id;
            }
        }
        

        // create notification
        $notification = new Notification([
            'type' => 'New Request',
            'user_id' => $hod,
            'requisition_id' => $requisition->id,
            'message' => 'New trip request from '.auth()->user()->f_name .' '.auth()->user()->l_name,
        ]);
        $notification->save();

        return redirect()->route('requests.index')->with('status','Request Submitted Successfully');
    }

    public function show($id) {
        $requisition = Requisition::findOrFail($id);
        dd($requisition);
    }

    public function edit($id) {  
        $requisition = Requisition::findOrFail($id);
        return view('requests.edit', compact('requisition'));

    }

    public function update(Request $request, $id) {  
        $requisition = Requisition::findOrFail($id);
        $data = $request->validate([
            'destination' => ['required', 'string', 'max:255'], 
            'client' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string', 'max:255'],
            'travel_mode' => ['required', 'max:255'],
            'accommodation' => ['required', 'max:255'],
            'trip_date' => ['required', 'date'],
        ]);
        $requisition->fill($data);
        $requisition->save();
        return redirect()->route('requests.index')->with('status', 'Request Updated Successfully'); 
    }

    public function destroy($id) { 
        $requisition = Requisition::findOrFail($id);  
        $requisition->delete();
        return redirect()->route('requests.index')->with('status', 'Request Deleted Successfully');

    }

    public function approve(Request $request) {
        $id = $request->input('id');
        $requisition = Requisition::findOrFail($id);

        $role = auth()->user()->roles->value('name');

        switch ($role) {
            case 'dept-adm':
                $requisition->adm_verified = 1;
                break;

            case 'hod-agm-gm':
                $requisition->hod_agm_gm_approved = 1;
                break;

            case 'director':
                $requisition->director_approved = 1;
                break;

            case 'ceo':
                $requisition->ceo_approved = 1;
                break;
            
            default:
                # code...
                break;
        }
        
        $requisition->status = 1;
        $requisition->processed_by = auth()->id();
        $requisition->save();

        Notification::create([
            'type'=> 'Request Approved',
            'user_id'=> $requisition->user()->value('id'),
            'requisition_id' => $requisition->id,
            'message'=> $request->input('message'),
        ]);

        return redirect()->route('requests.index')->with('status', 'Approved Successfully'); 

    }

    public function reject(Request $request) {
        $id = $request->input('id');
        $requisition = Requisition::findOrFail($id);

        $role = auth()->user()->roles->value('name');

        switch ($role) {
            case 'dept-adm':
                $requisition->adm_verified = 2;
                break;

            case 'hod-agm-gm':
                $requisition->hod_agm_gm_approved = 2;
                break;

            case 'director':
                $requisition->director_approved = 2;
                break;

            case 'ceo':
                $requisition->ceo_approved = 2;
                break;
            
            default:
                # code...
                break;
        }
    
        $requisition->status = 2;
        $requisition->save();

        Notification::create([
            'type'=> 'Request Declined',
            'user_id'=> $requisition->user()->value('id'),
            'requisition_id' => $requisition->id,
            'message'=> $request->input('message'),
        ]);
        
        return redirect()->route('requests.index')->with('status', 'Request Declined'); 

    }

    public function forward($id, $to) {
        $requisition = Requisition::findOrFail($id);
        
        if ($to==1) {
            $requisition->director_approved = 0;
        }
        if ($to==2) {
            $requisition->ceo_approved = 0;
        }
        $requisition->hod_agm_gm_approved = 3;
        if(auth()->user()->hasRole('director')) {
            $requisition->director_approved = 3;
            $users = User::all();
            foreach($users as $user) {
                if($user->hasRole(['super-admin', 'director'])) {
                    $ceo = $user->id;
                }
            }
        }
        $requisition->save();

        Notification::create([
            'type'=> 'New Request',
            'user_id'=> $ceo,
            'requisition_id' => $requisition->id,
            'message'=> 'New trip request from staff member',
        ]);

        return redirect()->route('requests.index')->with('status','Request Forwarded Successfully');
    }

}

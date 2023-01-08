<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Label;

class LabelController
{
    public function ListLabel()
    {
        $labels = $this->getProjects();
        return view('label/index', compact('labels'));
    }

    public function author($id){
        $labels = $this->getProjects(['project_id' => $id]);
        return $labels;
    }

    public function create()
    {
        $Label = new Label();
        return view('Label/form', compact('Label'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:name',
                'min:4',
                'max:8',
            ]
        ]);

        Label::create($request->all());
        return redirect()->route('label');
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return redirect()->route('label');
    }

    private function getProjects($params = [])
    {
        $labels = Label::with(['project']);
        if (!empty($params)) {
            $labels->where($params);
        }
        return $labels->get();
    }
}

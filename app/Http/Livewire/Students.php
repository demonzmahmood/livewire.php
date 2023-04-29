<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class Students extends Component
{
    use withFileUploads;

    public $students, $name, $grade, $department, $picture, $student_id;
    public $updateMode = false;

    public function render()
    {
            $this->students = $this->getCachedData();
            return view('livewire.students');

    }

    private function getCachedData()
    {
        return Cache::remember('students', 60, function () {
            $data = Student::all();
            return $data;
        });
    }

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->grade = '';
        $this->department = '';
        $this->picture = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'grade' => 'required',
            'department' => 'required',
            'picture' => 'nullable|image|max:1024',
        ]);

        $student = Student::create($validatedDate);

        $student->update([
            'picture' => $this->picture->store('pictures'),
        ]);

        session()->flash('message', 'Student Created Successfully.');

        $this->resetInputFields();

        Cache::forget('students');

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $this->student_id = $id;
        $this->name = $student->name;
        $this->grade = $student->grade;
        $this->department = $student->department;

        $this->updateMode = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'grade' => 'required',
            'department' => 'required',
            'picture' => 'nullable|image|max:1024',
        ]);

        $student = Student::find($this->student_id);
        $student->update([
            'name' => $this->name,
            'grade' => $this->grade,
            'department' => $this->department,
            'picture' => $this->picture ? $this->picture->store('pictures') : $student->picture,
        ]);

        $this->updateMode = false;

        session()->flash('message', 'Student Updated Successfully.');
        $this->resetInputFields();
        Cache::forget('students');

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Student::find($id)->delete();
        session()->flash('message', 'Student Deleted Successfully.');
        Cache::forget('students');
    }

}

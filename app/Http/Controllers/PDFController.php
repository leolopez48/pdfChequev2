<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Grade;
use App\Models\Professor;

class PDFController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDFTotal()
    {
        $professors = Professor::all();

        foreach ($professors as $prof) {
            $total = count(Professor::where('id', $prof->id)->get());
            $prof->total = $total;
            $prof->grade_name = Grade::where('id', $prof->grade_id)->first()->name;
        }
        // dd($professors);

        $pdf = PDF::loadView('PDF.report', compact('professors'));

        return $pdf->stream('report-'.now().'.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDFGroups()
    {
        // $data = Grade::select('*')
        // ->join('professors', 'grades.id', '=', 'professors.grade_id')
        // ->join('students', 'grades.id', '=', 'students.grade_id')
        // ->get();

        $firstGroup = Grade::select('*', 'grades.name as grade_name', 'students.age as student_age', 'students.last_names as student_last_names')
        ->join('professors', 'grades.id', '=', 'professors.grade_id')
        ->join('students', 'grades.id', '=', 'students.grade_id')
        ->whereBetween('students.final_grade', [1,3])
        ->get();

        $secondGroup = Grade::select('*', 'grades.name as grade_name', 'students.age as student_age', 'students.last_names as student_last_names')
        ->join('professors', 'grades.id', '=', 'professors.grade_id')
        ->join('students', 'grades.id', '=', 'students.grade_id')
        ->whereBetween('students.final_grade', [4,6])
        ->get();

        $thirdGroup = Grade::select('*', 'grades.name as grade_name', 'students.age as student_age', 'students.last_names as student_last_names')
        ->join('professors', 'grades.id', '=', 'professors.grade_id')
        ->join('students', 'grades.id', '=', 'students.grade_id')
        ->whereBetween('students.final_grade', [7,10])
        ->get();

        $pdf = PDF::loadView('PDF.report_groups', compact('firstGroup', 'secondGroup', 'thirdGroup'));

        return $pdf->stream('report-'.now().'.pdf');
    }

    public function generatePDFStudent($id)
    {
        $data = Grade::select('*', 'grades.name as grade_name', 'students.age as student_age', 'students.last_names as student_last_names')
        ->join('professors', 'grades.id', '=', 'professors.grade_id')
        ->join('students', 'grades.id', '=', 'students.grade_id')
        ->where('students.id', $id)
        ->get();

        $pdf = PDF::loadView('PDF.report_student', compact('data'));

        return $pdf->stream('report-'.now().'.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDFByDate(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $data = Student::whereRaw(
            "(created_at >= ? AND created_at <= ?)",
            [$start, $end]
        )->get();

        $pdf = PDF::loadView('PDF.report', compact('data'));

        return $pdf->stream('report-'.now().'.pdf');
    }
}

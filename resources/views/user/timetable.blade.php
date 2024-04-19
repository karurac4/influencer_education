@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
                <div class="d-flex ">
                    <a  href="{{ route('user.top') }}" class="text-decoration-none text-dark lead">←戻る</a>
                    <div class="mt-4 mx-3 d-flex align-items-center">
                        <button class="h3 bg-transparent border-0 p-o" id="dataDec">◀</button>
                        <div id='date'> </div>
                        <button class="h3 bg-transparent border-0 p-o" id="dataInc">▶</button>
                        <div id="grade">
                            <h4 class="mx-4 px-3 py-1 border border-secondary bg-primary text-white rounded grade" id=""></h4>
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div id="classesBlock" class="col-2 text-center mx-4 py-1">
                        
                    </div>
                    <div class="col-12 ms-4" >
                        
                        <div class="row row-cols-3" id="curriculumBlock">
                            
                        </div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
<style type="text/css">
    [v-cloak] {
        display: none;
    }
</style>
@section('content')
    <section class="content-header">
        <h1>
            Operation
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div id="app" class="row" v-cloak>
                    {!! Form::open(['route' => 'operations.store']) !!}
                        <!-- Operation Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('operation', 'Operation:') !!}
                            {!! Form::text('operation', null, ['class' => 'form-control', 'placeholder'=>'Indique la operación...']) !!}
                            {!! $errors->first('operation', '<div class="text-danger">:message</div>') !!}
                        </div>

                        <!-- Description Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('description', 'Description:') !!}
                            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder'=>'Indique la descripción...']) !!}
                            {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
                        </div>
                        <hr>

                        <!-- ************************************ Vue component ***************************** -->
                        <app-risk :old="'{{ json_encode(old()) }}'" :btn_save="'#btn_save'"></app-risk>

                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary','id'=>'btn_save']) !!}
                            <a href="{!! route('operations.index') !!}" class="btn btn-default">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/js/app.js')}}"></script> <!---->
@endsection

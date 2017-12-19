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
                        <!-- ************************************ inicio vue ***************************** 
                        <div v-if="errors.risks_empty">
                            <p class="alert alert-danger">@{{errors.risks_empty[0]}}</p>
                            <hr>
                        </div>-->

                        <div class="form-group col-sm-12"><strong>Lista de Riesgos</strong></div>
                        <div class="form-group col-sm-12">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Risks</th>
                                    <th>Details</th>
                                    <th colspan="3">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr is="app-risk" v-for="(risk, index) in risks" :risk="risk" :index="index" @remove="deleteRisk"></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <input type="text" v-model="new_risk" v-validate="'required'" name="risk" :disabled="editing">
                                        <li v-show="errors.has('risk')" class="text-danger">@{{errors.first('risk')}}</li>
                                    </td>
                                    <td>
                                        <textarea v-model="new_detail" v-validate="'required'" name="detail" :disabled="editing">
                                        </textarea>
                                        <li v-show="errors.has('detail')" class="text-danger">@{{errors.first('detail')}}</li>
                                    </td>
                                    <td>
                                        <span @click.prevent="createRisk" class="btn btn-primary" :disabled="editing">Add Risk</span>
                                        <span @click.prevent="resetRisk" class="btn btn-default" :disabled="editing">Reset</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- ************************************ final vue ***************************** -->
                        <!-- Submit Field -->
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('operations.index') !!}" class="btn btn-default">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/public/js/app.js')}}"></script> <!---->
@endsection

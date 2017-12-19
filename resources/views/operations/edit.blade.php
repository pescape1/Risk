@extends('layouts.app')

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
                    {!! Form::model($operation, ['route' => ['operations.update', $operation->id], 'method' => 'patch']) !!}
                        <!-- Operation Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('operation', 'Operation:') !!}
                            {!! Form::text('operation', old('operation',$operation->operation), ['class' => 'form-control', 'placeholder'=>'Indique la operación...']) !!}
                            {!! $errors->first('operation', '<div class="text-danger">:message</div>') !!}
                        </div>

                        <!-- Description Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('description', 'Description:') !!}
                            {!! Form::text('description', old('description',$operation->description), ['class' => 'form-control', 'placeholder'=>'Indique la descripción...']) !!}
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
<script type="text/javascript">
    window.risks = {!! $operation->risks->toJson() !!};
</script>
<script src="{{asset('/public/js/app.js')}}"></script> 
@endsection
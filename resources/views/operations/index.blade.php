@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Operations</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('operations.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="operations-table">
                    <thead>
                        <tr>
                            <th>Operation</th>
                            <th>Description</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($operations as $operation)
                        <tr>
                            <td>{!! $operation->operation !!}</td>
                            <td>{!! $operation->description !!}</td>
                            <td>
                                {!! Form::open(['route' => ['operations.destroy', $operation->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('operations.show', [$operation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{!! route('operations.edit', [$operation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @empty                            
                        <tr><td colspan="12"><span>No hay operaciones registradas.</span></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


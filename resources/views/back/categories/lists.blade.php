@extends('back.layouts.default')

@section('title')
文章分类列表
@stop

@section('links')
  <link href="css/table-responsive.css" rel="stylesheet"><!-- TABLE RESPONSIVE CSS -->
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header class="panel-heading">
          <span class="label label-primary">
            文章分类列表
          </span>
          
        </header>
        <div class="panel-body">
          <section id="no-more-tables">
            <table class="table table-bordered table-striped table-condensed cf">
              <thead class="cf">
                <tr>
                  <th>
                    Id
                  </th>
                  <th style="display: none;">
                    父级ID
                  </th>
                  <th>
                    名称
                  </th>
                  <th>
                    描述
                  </th>
                  <th>
                  操作
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cate as $v)
                <tr>
                  <td data-title="Id">
                    {{ $v->id }}
                  </td>
                  <td data-title="父级ID" style="display: none;">
                    {{ $v->pid }}
                  </td>
                  <td data-title="名称">
                    {{ str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v->level) }}  {{ $v->name }}
                  </td>
                  <td data-title="描述">
                    {{ $v->description }}
                  </td>
                  <td data-title="操作">
                    <button id="edit" data-id="{{ $v->id }}" type="button" class="btn btn-sm btn-round btn-info"> edit </button>
                    <button id="delete" data-id="{{ $v->id }}" type="button" class="btn btn-sm btn-round btn-danger"> delete </button>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </section>
        </div>
      </section>
    </div>
  </div>
@stop

@section('scripts')
<script>
$(function(){
  
});
</script>
@stop

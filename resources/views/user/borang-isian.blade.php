@extends('user')

@section('title', ' Isian Borang User')

@section('content')

		<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Isian Borang</h1>
                        <?php
                            $tahunini = date('Y');
                            for ($i=2016; $i <= $tahunini; $i++) { 
                                
                        ?>
                        <div class='div col-md-4' style="margin-top:20px">  
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <b>Isian Borang Tahun </b>
                            </div>
                            <div class="panel-body">
                                <a href="/user/isian/<?php echo $i; ?>"><?php echo $i; ?></a>
                            </div>
                        </div>
                        </div>
                        <?php    
                          }
                        ?>    
                    </div>
                </div>
            </div>
        </div>

@endsection

@extends('painel.template.Painel-Master')

@section('conteudo')
<!--BODY PAGE -->


<div class="page-body invoice-list-page">
    <div class='row'>
        <div class='col-md-12 col-sm-12'>
            <div class='row'>
                
            
    <!-- Basic table card start -->
    <div class="col-xl-10 col-lg-12 pull-xl-0  filter-bar">
                                                <!-- Navigation start -->
                                                <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                                                   
                                                        <div class="nav-item nav-grid">
                                                            <span class="m-r-15">Menu </span>
                                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-r-10" data-toggle="tooltip" data-placement="top" title="Nova Igreja">
                                                                <i class="icofont icofont-plus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-r-10" data-toggle="tooltip" data-placement="top" title="Vincular um padre a uma igreja">
                                                                <i class="icofont icofont-hotel-boy ico"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-r-10" data-toggle="tooltip" data-placement="top" title="Vincular um carro a uma igreja">
                                                                <i class="icofont icofont-police-car-alt-2"></i>
                                                            </button>
                                                            
                                                        </div>
                                                        <!-- end of by priority dropdown -->

                                                </nav>
                                                <!-- Navigation end  -->
                                                <div class="row">
                                                    <!-- Invoice list card start -->
                                                    <div class="col-sm-6">
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">SWIFT</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-primary">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                    </div>
                                                    <!-- Invoice list card end -->
                                                    <!-- Invoice list card start -->
                                                    <div class="col-sm-6">
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">Paypal</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-success">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown3" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                    </div>
                                                    <!-- Invoice list card end -->
                                                    <div class="col-sm-6">
                                                        <!-- Invoice list card start -->
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown12" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">Paypal</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-warning">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown8" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                        <!-- Invoice list card end -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- Invoice list card start -->
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">Payoneer</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-info">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown16" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown16" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                        <!-- Invoice list card end -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- Invoice list card start -->
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">Skrill</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown9" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                        <!-- Invoice list card end -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- Invoice list card start -->
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown13" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown13" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">SWIFT</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-primary">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown10" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                        <!-- Invoice list card end -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- Invoice list card start -->
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">Skrill</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-success">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown15" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown15" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                        <!-- Invoice list card end -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- Invoice list card start -->
                                                        <div class="card card-border-primary">
                                                            <div class="card-header">
                                                                <h5>John Doe </h5>
                                                                <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                                                                <div class="dropdown-secondary dropdown f-right">
                                                                    <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdown5" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Pending</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>Paid</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>On Hold</a>
                                                                        <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Canceled</a>
                                                                    </div>
                                                                    <!-- end of dropdown menu -->
                                                                    <span class="f-left m-r-5 text-inverse">Status : </span>
                                                                </div>
                                                            </div>
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled">
                                                                            <li>Invoice #: &nbsp;0028</li>
                                                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <ul class="list list-unstyled text-right">
                                                                            <li>$8,750</li>
                                                                            <li>Method: <span class="text-semibold">Paypal</span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="task-list-table">
                                                                    <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                                                </div>
                                                                <div class="task-board m-0">
                                                                    <a href="invoice.htm" class="btn btn-info btn-mini b-none"><i class="icofont icofont-eye-alt m-0"></i></a>
                                                                    <!-- end of dropdown-secondary -->
                                                                    <div class="dropdown-secondary dropdown">
                                                                        <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown11" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdown11" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                                                            <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                                                        </div>
                                                                        <!-- end of dropdown menu -->
                                                                    </div>
                                                                    <!-- end of seconadary -->
                                                                </div>
                                                                <!-- end of pull-right class -->
                                                            </div>
                                                            <!-- end of card-footer -->
                                                        </div>
                                                        <!-- Invoice list card end -->
                                                    </div>
                                                </div>
                  
    </div>
            </div>
            </div>
    </div>

</div>

<!-- BODY PAGE -->
@endsection

@section('css')
    
    
   
    
    <style>
    
    </style>
    
@endsection

@section('javascript')

    <!-- task board js -->
    <script type="text/javascript" src="{{asset('estilo_painel/assets/pages/task-board/task-board.js')}}"></script>
    <!-- Custom js -->  
    <script src="{{asset('estilo_painel/assets/js/meus/table-igrejas.js')}}"></script>
   
@endsection
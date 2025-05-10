@extends('layouts.app')
@section('content')
    <div class="row layout-top-spacing">
        <div class="row mb-2">
            <div class="col-12">
                <a href="/" class="btn btn-primary mr-2">Kembali</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPendidikTendik">
                    Import Data
                </button>

                <!-- Modal -->
                <div class="modal fade" id="tambahPendidikTendik" tabindex="-1" role="dialog"
                    aria-labelledby="tambahPendidikTendikTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahPendidikTendikTitle">Pendidik dan Tenaga Pendidik</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <form id="imporFormPendidikTendik" method="POST" action="{{ route('admin.pendidik-tendik.import') }}"
                                enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">
                                <h4 class="modal-heading mb-4 mt-2">Import Data</h4>
                                <p class="modal-text">Pilih file yang akan di Import ke sistem. Gunakan format <a href="#" class="text-bold text-primary">Impor Pendidik dan Tenaga Kependidikan</a>, agar data yang dimasukkan sesuai</p>
                                    <input type="file" class="form-control" name="file" id="formFile" />

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-light-dark" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Simple</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="avatar me-2">
                                                <img alt="avatar" src="../src/assets/img/profile-7.jpg"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">Shaun Park</h6>
                                                <span>shaun.park@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">CEO</p>
                                        <span class="text-success">Management</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light-success">Online</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btns">
                                            <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="avatar me-2">
                                                <img alt="avatar" src="../src/assets/img/profile-11.jpg"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">Alma Clarke</h6>
                                                <span>almaClarke@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">Lead Developer</p>
                                        <span class="text-secondary">Programmer</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light-secondary">Waiting</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btns">
                                            <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="avatar me-2">
                                                <img alt="avatar" src="../src/assets/img/profile-5.jpg"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">Vincent Carpenter</h6>
                                                <span>vincent@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">HR</p>
                                        <span class="text-danger">Management</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light-danger">Offline</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btns">
                                            <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="avatar me-2">
                                                <img alt="avatar" src="../src/assets/img/profile-34.jpg"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="media-body align-self-center">
                                                <h6 class="mb-0">Xavier</h6>
                                                <span>xavier@mail.com</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0">Lead Designer</p>
                                        <span class="text-info">Graphic</span>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge badge-light-info">On Hold</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="action-btns">
                                            <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-eye">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2"
                                                data-toggle="tooltip" data-placement="top" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-edit-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>



    </div>
@endsection

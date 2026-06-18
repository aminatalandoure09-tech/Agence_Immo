@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Modifier Terrain</h3>

            <a href="#"
               class="text-white text-decoration-none fs-3">
                &times;
            </a>
        </div>

        <div class="card-body p-5">

            <form action="#"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row mb-4 align-items-center">

                    <div class="col-md-3">
                        <label class="fw-bold">Nom :</label>
                    </div>

                    <div class="col-md-9">
                        <input type="text"
                               name="nom"
                               value="#"
                               class="form-control">
                    </div>

                </div>

                <div class="row mb-4 align-items-center">

                    <div class="col-md-3">
                        <label class="fw-bold">Superficie :</label>
                    </div>

                    <div class="col-md-9">
                        <input type="text"
                               name="superficie"
                               value="#"
                               class="form-control">
                    </div>

                </div>

                <div class="row mb-4 align-items-center">

                    <div class="col-md-3">
                        <label class="fw-bold">Image :</label>
                    </div>

                    <div class="col-md-9">
                        <input type="file"
                               name="image"
                               class="form-control">
                    </div>

                </div>

                <div class="row mb-4 align-items-center">

                    <div class="col-md-3">
                        <label class="fw-bold">Prix :</label>
                    </div>

                    <div class="col-md-9">
                        <input type="number"
                               name="prix"
                               value="#"
                               class="form-control">
                    </div>

                </div>

                <div class="text-end mt-5">

                    <a href="#"
                       class="btn btn-secondary">
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn btn-dark px-4">
                        Modifier
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
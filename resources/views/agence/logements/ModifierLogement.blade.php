@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Modifier Logement</h3>

            <a href="#" class="text-white text-decoration-none fs-3">
                &times;
            </a>
        </div>

        <div class="card-body p-5">

            <form action="#"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <input type="text"
                           name="titre"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <textarea name="description"
                              class="form-control"
                              rows="3">#</textarea>
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="superficie"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <input type="file"
                           name="photo"
                           class="form-control">
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="prix"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="nbrePiece"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="nbreChambre"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="nbreSalleBain"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <input type="text"
                           name="typeLogement"
                           class="form-control"
                           value="#">
                </div>

                <div class="mb-4">
                    <select name="meuble" class="form-control">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
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
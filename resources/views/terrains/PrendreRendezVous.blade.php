@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow-lg border-0">

<div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #071238;">                    
    <h3 class="mb-0">Demande de rendez-vous</h3>

                    <a href="{{ url('/terrains') }}"
                       class="btn btn-light btn-sm">
                        ✕
                    </a>
                </div>

                <div class="card-body p-4">

                    <form action="#" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Date souhaitée
                            </label>

                            <input type="date"
                                   class="form-control form-control-lg"
                                   name="date"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Heure souhaitée
                            </label>

                            <input type="time"
                                   class="form-control form-control-lg"
                                   name="heure"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Message (facultatif)
                            </label>

                            <textarea
                                class="form-control"
                                rows="4"
                                name="message"
                                placeholder="Ajoutez un commentaire..."></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                    class="btn btn-success btn-lg px-5">
                                Envoyer la demande
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection
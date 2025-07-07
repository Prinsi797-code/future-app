@extends('layouts.app')
<style>
    .btn-group-toggle .btn {
        border-radius: 20px;
        /* pill shape */
        min-width: 120px;
        /* width to look consistent */
        text-align: center;
    }
</style>
@section('content')
    <div class="container mt-5">
        <h2>Entrepreneur Details</h2>
        <form action="{{ route('entrepreneur.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="form-group">
                <label>Startup/Business Name</label>
                <input type="text" class="form-control" name="startup_name" required>
            </div>

            <div class="form-group">
                <label>Industry</label>
                <select name="industry" class="form-control" required>
                    <option value="Tech">Tech</option>
                    <option value="Healthcare">Healthcare</option>
                    <!-- Add more -->
                </select>
            </div>

            <div class="form-group">
                <label>Stage of Business</label>
                <div class="btn-group btn-group-toggle d-flex flex-wrap" data-toggle="buttons">
                    <label class="btn btn-outline-primary m-1">
                        <input type="radio" name="stage" value="Idea" autocomplete="off" required> Idea
                    </label>
                    <label class="btn btn-outline-primary m-1">
                        <input type="radio" name="stage" value="Prototype" autocomplete="off" required> Prototype
                    </label>
                    <label class="btn btn-outline-primary m-1">
                        <input type="radio" name="stage" value="Revenue-Generating" autocomplete="off" required>
                        Revenue-Generating
                    </label>
                    <label class="btn btn-outline-primary m-1">
                        <input type="radio" name="stage" value="Funded" autocomplete="off" required> Funded
                    </label>
                </div>
            </div>


            <div class="form-group">
                <label>Summary (max 300 words)</label>
                <textarea name="summary" class="form-control" rows="4" maxlength="300" required></textarea>
            </div>

            <div class="form-group">
                <label>Funding Requirement ($)</label>
                <input type="number" name="funding_requirement" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Upload Pitch Deck (PDF)</label>
                <input type="file" name="pitch_deck" class="form-control-file" accept="application/pdf">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="agree" required>
                <label class="form-check-label">I agree to the Terms & Conditions</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit Pitch</button>
        </form>
    </div>
@endsection

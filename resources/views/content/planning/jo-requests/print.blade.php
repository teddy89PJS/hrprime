<!DOCTYPE html>
<html>

<head>
  <title>JO Request Print</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
    }

    h3 {
      text-align: center;
    }

    .label {
      font-weight: bold;
      margin-top: 20px;
    }

    .section {
      margin-bottom: 10px;
    }

    @media print {
      button {
        display: none;
      }
    }
  </style>
</head>

<body>

  <h3>Request for {{ ucfirst($joRequest->type) }} of JO Position</h3>

  <div class="section">
    <div class="label">Subject:</div>
    <div>{{ $joRequest->subject }}</div>
  </div>

  <div class="section">
    <div class="label">Position Title:</div>
    <div>{{ $joRequest->position_name }}</div>
  </div>

  <div class="section">
    <div class="label">Number of Positions:</div>
    <div>{{ $joRequest->no_of_position }}</div>
  </div>

  <div class="section">
    <div class="label">Effectivity Date:</div>
    <div>{{ \Carbon\Carbon::parse($joRequest->effectivity_of_position)->format('F d, Y') }}</div>
  </div>

  <div class="section">
    <div class="label">Section:</div>
    <div>{{ $joRequest->section->name ?? 'N/A' }}</div>
  </div>

  <div class="section">
    <div class="label">Fund Source:</div>
    <div>{{ $joRequest->fundSource->fund_source ?? 'N/A' }}</div>
  </div>

  <div class="section">
    <div class="label">Remarks:</div>
    <div>{{ $joRequest->remarks }}</div>
  </div>

  <div class="section">
    <div class="label">Date Submitted:</div>
    <div>{{ $joRequest->created_at->format('F d, Y h:i A') }}</div>
  </div>

  <br><br>
  <button onclick="window.print()">Print</button>

</body>

</html>

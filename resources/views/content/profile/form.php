<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Personal Data Sheet (CSC Form 212)</title>
  <style>
  @page { margin: 5mm 5mm; size: legal portrait; }
  body {
    font-family: 'Arial Black', Arial, sans-serif;
    font-size: 10px;
    color: #000000;
    margin: 0;
  }

  .container { width: 100%; padding: 4px; box-sizing: border-box; }
  .header { width: 100%; }
  .title {
    font-size: 20px;
    font-weight: 800;
    text-align: center;
    margin: 2px 0 6px;
  }
  .subtitle {
    text-align: center;
    font-size: 9px;
    margin-bottom: 6px;
  }

  /* ✅ Uniform border thickness (1px black) for all tables */
  table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid #000;
  }
  th, td {
    border: 1px solid #000;
    padding: 4px;
    vertical-align: top;
  }

  /* Table styling consistency */
  .tbl { border: 1px solid #000; }
  .tbl th, .tbl td {
    border: 1px solid #000;
    padding: 4px;
    vertical-align: top;
  }

  .section {
    background: #000;
    color: #fff;
    font-weight: 700;
    padding-left: 6px;
  }

  .small { font-size: 9px; }
  .checkbox {
    display: inline-block;
    width: 12px;
    height: 12px;
    border: 1px solid #000;
    margin-right: 6px;
    vertical-align: middle;
  }
  .checked { background: #000; }
  .right { text-align: right; }
  .center { text-align: center; }
  .muted { color: #000; font-size: 9px; }
  .page-break { page-break-after: always; }

  /* narrow columns for form-like layout */
  .col-1 { width: 12%; }
  .col-2 { width: 18%; }
  .col-3 { width: 25%; }
  .col-4 { width: 45%; }

  /* inline text spacing for inputs */
  .input-inline { padding-left: 6px; }

  /* compact layout for dense rows */
  .compact td { padding: 3px 4px; font-size: 10px; }

  /* prevent wrapping for small text fields */
  .no-wrap { white-space: nowrap; }
</style>

</head>
<body>
<div class="container">

 <table border="1" cellspacing="0" cellpadding="" style="width:100%; border-collapse: collapse; font-size:10px; margin:none ">

  <!-- HEADER -->
  <tr>
    <td colspan="9" style="padding:0;">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div style="font-size:11px; font-weight:700; font-style:italic;">CS Form No. 212</div>
        <div style="font-size:9px; font-style:italic;">Revised 2025</div>
        <div style="font-size:22px; font-weight:bolder; text-align:center; width:100%; margin: -10px 0 0 0; letter-spacing: 5px;">PERSONAL DATA SHEET</div>
      </div>

      <p style="font-style:italic; font-size:8px; font-weight:bold; margin:8px 0;">
        WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.
      </p>

      <p style="font-style:italic; font-size:8px; font-weight:bold; margin:2px 0;">
        READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.
      </p>

      <p style="font-size:8px; margin:2px 0;">
        Print legibly if accomplished through own handwriting. Tick appropriate boxes (<span style="display:inline-block; width:10px; height:10px; border:1px solid #000;"></span>) and use separate sheet if necessary. Indicate N/A if not applicable. <strong>DO NOT ABBREVIATE.</strong>
      </p>
    </td>
  </tr>

  <!-- I. PERSONAL INFORMATION HEADER -->
  <tr style="background:#969696; font-weight:bold; color: #ffff; border-bottom: solid 2px #000; border-top: solid 2px #000;">
    <td colspan="9" style="">I. PERSONAL INFORMATION</td>
  </tr>

  <!-- PERSONAL INFO ROWS -->
  <tr>
    <!-- LAST NAME -->
    <td style="width: 18%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; border-bottom:  solid 1px #EAEAEA; background-color: #EAEAEA">
      1. SURNAME
    </td>
    <td colspan="8" style="border-bottom: solid 1px;padding: 4px; "><span style="font-weight:bold; color: #000;" >&nbsp;&nbsp;{{ strtoupper($employee->last_name ?? '') }}</span>
    </td>
  </tr>
  <tr>
    <!-- FIRST NAME -->
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; border-bottom:  solid 1px #EAEAEA; background-color: #EAEAEA;">
      2. FIRST NAME
    </td>
    <td colspan="4" style="border-bottom: solid 1px; padding: 4px; "><span style="font-weight:bold; color: #000; " >&nbsp;&nbsp;{{ strtoupper($employee->first_name ?? '') }}</span>
    <!-- EXTENSION NAME -->
    <td colspan="4"style="width: 30%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; border-bottom: solid 1px; background-color: #EAEAEA;">
      EXTENSION NAME (JR., SR.) &nbsp;&nbsp;&nbsp;&nbsp;
      <span style="font-size: 12px; color: #000; font-weight: bold;">
        {{ strtoupper($employee->extension_name ?? '') }}
      </span>
    </td>
  </tr>
  <tr>
    <!-- MIDDLE NAME -->
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; border-bottom: solid 2px #000; background-color: #EAEAEA">
      &nbsp;&nbsp;&nbsp;&nbsp;MIDDLE NAME
    </td>
    <td colspan="8" style=" border-bottom: solid 2px #000; padding: 4px; "><span style="font-weight:bold; color: #000; " >&nbsp;&nbsp;{{ strtoupper($employee->middle_name ?? '') }}</span>
  </tr>
  <tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      3. DATE OF BIRTH <br><span style="color: #000000ff;">&nbsp;&nbsp;&nbsp;&nbsp;(dd/mm/yyyy)</span>
    </td>
    <td colspan="1" style="width: 23%; font-weight: bold">&nbsp;&nbsp;
      {{ strtoupper(\Carbon\Carbon::parse($employee->birthday ?? '')->format('F d, Y')) }}
    </td>
    <td rowspan="4" colspan="2" style="
      font-size: 8px; 
      color: #000000ff; 
      text-align: center; 
      vertical-align: top; 
      border-left: solid 1.5px #000000ff; 
      background-color: #EAEAEA; 
      width:20%;
    ">
      <div style="text-align: left; margin-bottom: 15px;">
        16. CITIZENSHIP
      </div>
      <div style="font-size: 8px; line-height: 15px;">
        If holder of dual citizenship,<br>
        please indicate the details.
      </div>
    </td>
<td rowspan="2" colspan="4" style="width: 22%; vertical-align: top; border-bottom: 1.5px solid #000; padding: 3px; font-size: 9px;">

  <!-- First row: main citizenship checkboxes -->
  <div>
    <label style="margin-right: 10px;">
      <input type="checkbox" name="citizenship" value="Filipino" style="vertical-align: middle;"> Filipino
    </label>
    <label>
      <input type="checkbox" name="citizenship" value="Dual" style="vertical-align: middle;"> Dual Citizenship
    </label>
  </div>

  <!-- Second row: sub checkboxes and country input label -->
  <div style="margin-top: 4px; padding-left: 75px;"> <!-- padding-left aligns with Dual Citizenship -->
    <label style="margin-right: 10px;">
      <input type="checkbox" name="dual_type" value="birth" style="vertical-align: middle;"> by birth
    </label>
    <label style="margin-right: 10px;">
      <input type="checkbox" name="dual_type" value="naturalization" style="vertical-align: middle;"> by naturalization
    </label>
    <br>
    <span>Pls. indicate country:</span>
  </div>

</td>


  </tr>
    <tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      4. PLACE OF BIRTH
    </td>
    <td colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
    </td>
  </tr>
    <tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      5. SEX AT BIRTH
    </td>
      <td colspan="1" style="text-align: center; vertical-align: middle;">
        <span class="checkbox @if(isset($basicInfo->sex) && strtolower($basicInfo->sex)=='male') checked @endif"></span>
        <span style="margin-right: 45px;">Male</span>

        <span class="checkbox @if(isset($basicInfo->sex) && strtolower($basicInfo->sex)=='female') checked @endif"></span>
        <span>Female</span>
      </td>
          <td colspan="4" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->perm_country ?? '') }}
    </td>
    </tr>
  <tr>
    <td rowspan="4" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      6. CIVIL STATUS
    </td>
    <td rowspan="4" colspan="1" style="vertical-align: top; padding:3px; font-size:9px;">
      @php $cs = strtolower($basicInfo->civil_status ?? '') @endphp
      <div style="margin-bottom:10px;">
        <label style="margin-right:15px;">
          <span class="checkbox @if($cs=='single') checked @endif"></span> Single
        </label>
        <label style="margin-right:15px;">
          <span class="checkbox @if($cs=='married') checked @endif"></span> Married
        </label>
        <br>
        <label style="margin-right:15px;">
          <span class="checkbox @if($cs=='widowed') checked @endif"></span> Widowed
        </label>
        <label style="margin-right:15px;">
          <span class="checkbox @if($cs=='separated') checked @endif"></span> Separated
        </label>
      </div>
      <div>
        <label>
          <span class="checkbox @if($cs=='others') checked @endif"></span> Other/s: {{ $basicInfo->civil_status_other ?? '' }}
        </label>
      </div>
    </td>

    <td rowspan="6" colspan="1" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      17. RESIDENTIAL ADDRESS
        <td rowspan="1" colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
        </td>
        <td rowspan="1" colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
        </td>
      </tr>

      <tr>
        <td colspan="2" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">House/Block/Lot No.
      </i></center></td>
      <td colspan="3" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Street
      </i></center></td>
      </tr>
      <tr>
          <td rowspan="1" colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
        </td>
        <td rowspan="1" colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
        </td>
      </tr>

      <tr>
        <td colspan="2" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Subdivision/Village
      </i></center></td>
      <td colspan="3" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Barangay
      </i></center></td>
      <tr>

    <td  rowspan="2" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      7. HEIGHT (m)
    </td>
    <td  rowspan="2" colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->height ?? '') }}
    </td>
    <td rowspan="1" colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
    </td>
    <td rowspan="1" colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
    </td>
      <tr>
        <td colspan="2" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">City/Municipality
      </i></center></td>
      <td colspan="3" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Province
      </i></center></td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     8. WEIGHT (kg)
    </td>
    <td colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->weight ?? '') }}
    </td>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     ZIP CODE
    </td>
    <td colspan="5" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->res_zipcode ?? '') }}
    </td>
</tr>
<tr>
    <td rowspan="2" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      9. BLOOD TYPE
    </td>
    <td rowspan="2" colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->blood_type ?? '') }}
    </td>
    <td rowspan="6" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      18. PERMANENT ADDRESS
    </td>
      <td rowspan="1" colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
      </td>
      <td rowspan="1" colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
      </td>
      <tr>
        <td colspan="2" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Subdivision/Village
      </i></center></td>
      <td colspan="3" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Barangay
      </i></center></td>
</tr>
<tr>
    <td rowspan="2" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      10. UMID ID NO.
    </td>
    <td rowspan="2" colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->sss_id ?? '') }}
    </td>
      <td rowspan="1" colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
      </td>
      <td rowspan="1" colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
      </td>
      <tr>
        <td colspan="2" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Subdivision/Village
      </i></center></td>
      <td colspan="3" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Barangay
      </i></center></td>
</tr>
<tr>
    <td rowspan="2" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      11. PAG-IBIG ID NO.
    </td>
    <td rowspan="2" colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->sss_id ?? '') }}
    </td>
      <td rowspan="1" colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
      </td>
      <td rowspan="1" colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->place_of_birth ?? '') }}
      </td>
      <tr>
        <td colspan="2" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Subdivision/Village
      </i></center></td>
      <td colspan="3" style="border-right:none;border-left:1;border-bottom:1;border-top:none;  height:4px"><center><i style="font-size: 9px;">Barangay
      </i></center></td>
</tr>
<tr>
    <td rowspan="1" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      12. PHILHEALTH ID NO.
    </td>
    <td rowspan="1" colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     ZIP CODE
    </td>
    <td colspan="5" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->res_zipcode ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      13. PhilSys Number (PSN):
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td colspan="1" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     19. TELEPHONE NO.
    </td>
    <td colspan="5" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->telephone ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      14. TIN NO.
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td colspan="1" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     20. MOBILE NO.
    </td>
    <td colspan="5" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->telephone ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
      15. AGENCY EMPLOYEE NO.
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td colspan="1" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     21. E-MAIL ADDRESS (if any)
    </td>
    <td colspan="5" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->telephone ?? '') }}
    </td>
</tr>
<tr style="background:#969696; font-weight:bold; color: #ffff; border-bottom: solid 2px #000; border-top: solid 2px #000;">
  <td colspan="9" style="">II. FAMILY BACKGROUND</td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
     22. SPOUSE'S SURNAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td colspan="3" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     23. NAME of CHILDREN (Write full name and list all)
    </td>
    <<td colspan="2" style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     DATE OF BIRTH (dd/mm/yyyy)
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA; ">
      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;FIRST NAME
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     NAME EXTENSION (JR., SR)
    </td>
    <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;MIDDLE NAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;OCCUPATION
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;EMPLOYER/BUSINESS NAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;BUSINESS ADDRESS
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;TELEPHONE NO.
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
     24. FATHER'S SURNAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA; ">
      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;FIRST NAME
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     NAME EXTENSION (JR., SR)
    </td>
    <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;MIDDLE NAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
<td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom: 1px solid #EAEAEA; border-right:1px solid #EAEAEA;">
    24. MOTHER'S MAIDEN NAME
</td>
    <td  colspan="2" style="font-weight: bold; background-color: #EAEAEA;">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
     <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA; ">
      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;SURNAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;FIRST NAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>

    <td  colspan="3" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;MIDDLE NAME
    </td>
    <td  colspan="2" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </i></center></td>
      <td colspan="5" style="font-weight: bold; color: #df1919ff"><center><i style="font-size: 9px;">(Continue on separate sheet if necessary)
    </i></center></td>
</tr>
<tr style="background:#969696; font-weight:bold; color: #ffff; border-bottom: solid 2px #000; border-top: solid 2px #000;">
  <td colspan="9" style="">III. EDUCATIONAL BACKGROUND</td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      26. <br> <center> LEVEL</center>
    </td>
    <td style="width: 10%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      <center> NAME OF SCHOOL <br> (Write in full)</center>
    </td>
        <td style="width: 25%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      <center>BASIC EDUCATION/DEGREE/COURSE <br> (Write in full)</center>
    </td>
        <td colspan="2"style="width: 13%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      <center>PERIOD OF ATTENDANCE</center>
    </td>
        <td style="width: 10%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      <center>HIGHEST LEVEL/UNITS EARNED <br> (if not graduated)</center>
    </td>
        <td style="width: 10%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      <center>YEAR GRADUATED</center>
    </td>
        <td style="width: 10%; font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA; border-bottom:  solid 1px #EAEAEA;">
      <center>SCHOLARSHIP/ ACADEMIC HONORS RECEIVED</center>
    </td>
</tr>
<tr>
    <td style="font-size: 8px; color: #000000ff; vertical-align: top; text-align: left; background-color: #EAEAEA">
     &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;ELEMENTARY
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
    <td  colspan="1" style="font-weight: bold">&nbsp;&nbsp;&nbsp;{{ strtoupper($employee->philhealth_id ?? '') }}
    </td>
</tr>
</table>

</table>


  {{-- PAGE BREAK --}}
  <div class="page-break"></div>

  {{-- PAGE 2 --}}
  <div style="margin-top:4px;">
    <table class="tbl compact">
      <tr><td class="section">III. EDUCATIONAL BACKGROUND</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <th style="border:1px solid #000; padding:4px; width:12%;">Level</th>
              <th style="border:1px solid #000; padding:4px; width:38%;">Name of School</th>
              <th style="border:1px solid #000; padding:4px; width:25%;">Basic/Academic Degree/Course</th>
              <th style="border:1px solid #000; padding:4px; width:12%;">Period of Attendance</th>
              <th style="border:1px solid #000; padding:4px; width:13%;">Highest Level/Units Earned</th>
              <th style="border:1px solid #000; padding:4px; width:10%;">Year Graduated</th>
              <th style="border:1px solid #000; padding:4px; width:12%;">Scholarship/Academic Honors Received</th>
            </tr>

            @if(count($education ?? []) > 0)
              @foreach($education as $ed)
                <tr>
                  <td style="padding:4px;">{{ $ed->level ?? '' }}</td>
                  <td style="padding:4px;">{{ $ed->school_name ?? '' }}</td>
                  <td style="padding:4px;">{{ $ed->course ?? '' }}</td>
                  <td style="padding:4px;">{{ $ed->period_from ?? '' }} - {{ $ed->period_to ?? '' }}</td>
                  <td style="padding:4px;">{{ $ed->highest_level_units ?? '' }}</td>
                  <td style="padding:4px;">{{ $ed->year_graduated ?? '' }}</td>
                  <td style="padding:4px;">{{ $ed->honors_received ?? '' }}</td>
                </tr>
              @endforeach
            @else
              @for($i=0;$i<6;$i++)
                <tr>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                </tr>
              @endfor
            @endif
          </table>
        </td>
      </tr>
    </table>

    <table class="tbl compact" style="margin-top:6px;">
      <tr><td class="section">IV. CIVIL SERVICE ELIGIBILITY</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <th style="border:1px solid #000; padding:4px; width:30%;">Eligibility</th>
              <th style="border:1px solid #000; padding:4px; width:15%;">Rating</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">Date of Exam/Release</th>
              <th style="border:1px solid #000; padding:4px; width:35%;">License No. (if applicable)</th>
            </tr>
            @if(count($eligibility ?? []) > 0)
              @foreach($eligibility as $el)
                <tr>
                  <td style="padding:4px;">{{ $el->eligibility ?? '' }}</td>
                  <td style="padding:4px;">{{ $el->rating ?? '' }}</td>
                  <td style="padding:4px;">{{ $el->exam_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $el->license_number ?? '' }}</td>
                </tr>
              @endforeach
            @else
              @for($i=0;$i<4;$i++)
                <tr>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                </tr>
              @endfor
            @endif
          </table>
        </td>
      </tr>
    </table>

    <table class="tbl compact" style="margin-top:6px;">
      <tr><td class="section">V. WORK EXPERIENCE (Start with your present employer)</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <th style="border:1px solid #000; padding:4px; width:20%;">From</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">To</th>
              <th style="border:1px solid #000; padding:4px; width:25%;">Position Title</th>
              <th style="border:1px solid #000; padding:4px; width:25%;">Company/Organization</th>
              <th style="border:1px solid #000; padding:4px; width:10%;">Monthly Salary</th>
            </tr>

            @if(count($work ?? []) > 0)
              @foreach($work as $w)
                <tr>
                  <td style="padding:4px;">{{ $w->from_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $w->to_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $w->position_title ?? '' }}</td>
                  <td style="padding:4px;">{{ $w->company_name ?? '' }} <br> {{ $w->address ?? '' }}</td>
                  <td style="padding:4px;">{{ $w->monthly_salary ?? '' }}</td>
                </tr>
              @endforeach
            @else
              @for($i=0;$i<6;$i++)
                <tr>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                </tr>
              @endfor
            @endif
          </table>
        </td>
      </tr>
    </table>
  </div>

  {{-- PAGE BREAK --}}
  <div class="page-break"></div>

  {{-- PAGE 3 --}}
  <div>
    <table class="tbl compact">
      <tr><td class="section">VI. VOLUNTARY WORK/INVOLVEMENT</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <th style="border:1px solid #000; padding:4px; width:40%;">Name & Address of Organization</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">From</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">To</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">Number of Hours</th>
            </tr>
            @if(count($voluntary ?? []) > 0)
              @foreach($voluntary as $v)
                <tr>
                  <td style="padding:4px;">{{ $v->organization_name ?? '' }} <br> {{ $v->address ?? '' }}</td>
                  <td style="padding:4px;">{{ $v->from_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $v->to_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $v->hours ?? '' }}</td>
                </tr>
              @endforeach
            @else
              @for($i=0;$i<6;$i++)
                <tr>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                </tr>
              @endfor
            @endif
          </table>
        </td>
      </tr>
    </table>

    <table class="tbl compact" style="margin-top:6px;">
      <tr><td class="section">VII. LEARNING AND DEVELOPMENT (L&D)</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <th style="border:1px solid #000; padding:4px; width:40%;">Title of Learning Event</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">From</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">To</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">No. of Hours</th>
            </tr>
            @if(count($learning ?? []) > 0)
              @foreach($learning as $l)
                <tr>
                  <td style="padding:4px;">{{ $l->title ?? '' }} <br> {{ $l->conducted_by ?? '' }}</td>
                  <td style="padding:4px;">{{ $l->from_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $l->to_date ?? '' }}</td>
                  <td style="padding:4px;">{{ $l->hours ?? '' }}</td>
                </tr>
              @endforeach
            @else
              @for($i=0;$i<6;$i++)
                <tr>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                </tr>
              @endfor
            @endif
          </table>
        </td>
      </tr>
    </table>

    <table class="tbl compact" style="margin-top:6px;">
      <tr><td class="section">VIII. OTHER INFORMATION</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <td style="width:33%; border:1px solid #000; padding:4px;">Special Skills / Hobbies</td>
              <td style="width:67%; border:1px solid #000; padding:4px;">{{ implode(', ', $skills->pluck('name')->toArray() ?? []) }}</td>
            </tr>
            <tr>
              <td style="border:1px solid #000; padding:4px;">Non-Academic Distinctions / Recognitions</td>
              <td style="border:1px solid #000; padding:4px;">
                @if(count($nonAcademic ?? []) > 0)
                  <ul style="margin:6px 0 0 16px; padding:0;">
                    @foreach($nonAcademic as $n)
                      <li>{{ $n->title ?? '' }} ({{ $n->year ?? '' }})</li>
                    @endforeach
                  </ul>
                @else
                  N/A
                @endif
              </td>
            </tr>
            <tr>
              <td style="border:1px solid #000; padding:4px;">Membership in Associations/Organizations</td>
              <td style="border:1px solid #000; padding:4px;">
                @if(count($organization ?? []) > 0)
                  <ul style="margin:6px 0 0 16px; padding:0;">
                    @foreach($organization as $o)
                      <li>{{ $o->name ?? '' }} — {{ $o->position ?? '' }}</li>
                    @endforeach
                  </ul>
                @else
                  N/A
                @endif
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

  </div>

  {{-- PAGE BREAK --}}
  <div class="page-break"></div>

  {{-- PAGE 4 --}}
  <div>
    <table class="tbl compact">
      <tr><td class="section">IX. REFERENCES</td></tr>
      <tr>
        <td style="padding:6px;">
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <th style="border:1px solid #000; padding:4px; width:35%;">Name</th>
              <th style="border:1px solid #000; padding:4px; width:45%;">Address</th>
              <th style="border:1px solid #000; padding:4px; width:20%;">Contact No.</th>
            </tr>
            @if(count($references ?? []) > 0)
              @foreach($references as $r)
                <tr>
                  <td style="padding:4px;">{{ $r->name ?? '' }}</td>
                  <td style="padding:4px;">{{ $r->address ?? '' }}</td>
                  <td style="padding:4px;">{{ $r->contact ?? '' }}</td>
                </tr>
              @endforeach
            @else
              @for($i=0;$i<5;$i++)
                <tr>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                  <td style="padding:6px;">&nbsp;</td>
                </tr>
              @endfor
            @endif
          </table>
        </td>
      </tr>
    </table>

    <table class="tbl compact" style="margin-top:6px;">
      <tr><td class="section">X. CERTIFICATION</td></tr>
      <tr>
        <td style="padding:8px;">
          I CERTIFY that all the entries in this Personal Data Sheet are true and correct to the best of my knowledge and belief.
          <br><br>
          <table style="width:100%; border-collapse: collapse;">
            <tr>
              <td style="width:60%; border:1px solid #000; padding:6px; height:60px;">
                <div style="font-weight:700;">Signature Over Printed Name</div>
                <div class="muted">Date: {{ now()->format('F d, Y') }}</div>
              </td>
              <td style="width:40%; border:1px solid #000; padding:6px;">
                <div style="font-weight:700;">Right Thumbmark</div>
                <div style="height:40px;">&nbsp;</div>
              </td>
            </tr>
          </table>

          <p style="margin-top:8px; font-size:10px;">(Continue on next page if necessary)</p>
        </td>
      </tr>
    </table>

  </div>
</div>
</body>
</html>

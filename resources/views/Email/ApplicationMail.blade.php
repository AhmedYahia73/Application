<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Job data</title>
<style>
    /* Simple, email-friendly styling (use inline-safe CSS) */
    body { font-family: Arial, Helvetica, sans-serif; background:#f5f7fa; margin:0; padding:20px; color:#333; }
    .container { max-width:700px; margin:0 auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.08); }
    .header { background:#0b6efd; color:#fff; padding:18px 24px; }
    .header h1 { margin:0; font-size:20px; }
    .content { padding:20px 24px; }
    .lead { margin:0 0 12px 0; color:#555; }
    table { width:100%; border-collapse:collapse; margin-top:12px; }
    th, td { text-align:left; padding:10px 8px; border-bottom:1px solid #eef1f5; vertical-align:top; }
    th { width:180px; color:#666; font-weight:600; background: #fafbfc; }
    .footer { padding:16px 24px; font-size:13px; color:#777; background:#fbfdff; }
    .badge { display:inline-block; padding:6px 10px; border-radius:12px; background:#e9f2ff; color:#0450c9; font-weight:600; font-size:13px; }
    @media only screen and (max-width:600px) {
        .header h1 { font-size:18px; }
        th { display:block; width:100%; }
        td { display:block; width:100%; padding:8px 0; }
        table { margin-top:8px; }
    }
</style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>New Job Application</h1>
    </div>

    <div class="content">
      <p class="lead">You have received a new job application. Below are the details submitted by the applicant.</p>

      <table role="presentation" cellspacing="0" cellpadding="0">
        <tr>
          <th>Full name</th>
          <td>{{ $data['name'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Qualification</th>
          <td>{{ $data['qualification'] ?? ($data['qualification_id'] ?? '-') }}</td>
        </tr>

        <tr>
          <th>Job applied</th>
          <td>{{ $data['job'] ?? ($data['job_id'] ?? '-') }}</td>
        </tr>

        <tr>
          <th>City</th>
          <td>{{ $data['city'] ?? ($data['city_id'] ?? '-') }}</td>
        </tr>

        <tr>
          <th>Birth date</th>
          <td>{{ $data['birth_date'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Graduate date</th>
          <td>{{ $data['graduate_date'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Address</th>
          <td>{{ $data['address'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Phone</th>
          <td>{{ $data['phone'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Current job</th>
          <td>{{ $data['current_job'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Experiences</th>
          <td>{!! nl2br(e($data['experiences'] ?? '-')) !!}</td>
        </tr>

        <tr>
          <th>Courses</th>
          <td>{!! nl2br(e($data['courses'] ?? '-')) !!}</td>
        </tr>

        <tr>
          <th>Expected salary</th>
          <td>{{ isset($data['expected_salary']) ? $data['expected_salary'] : '-' }}</td>
        </tr>

        <tr>
          <th>University</th>
          <td>{{ $data['university'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>College</th>
          <td>{{ $data['collage'] ?? '-' }}</td>
        </tr>

        <tr>
          <th>Marital status</th>
          <td><span class="badge">{{ $data['marital'] ?? '-' }}</span></td>
        </tr>

        <tr>
          <th>Children</th>
          <td>{{ isset($data['children']) ? $data['children'] : '-' }}</td>
        </tr>
      </table>

      @if(!empty($data['attachments']))
        <p style="margin-top:14px;">Attachments: please check the data record or attachments folder.</p>
      @endif

    </div>

    <div class="footer">
      <div>Regards,<br/>HR System</div>
      <div style="margin-top:8px; font-size:12px; color:#999;">This is an automated message — do not reply to this email.</div>
    </div>
  </div>
</body>
</html>

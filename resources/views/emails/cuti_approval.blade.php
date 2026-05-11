<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Cuti</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f4f4f4; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:20px;">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="background:#007bff; color:#ffffff; padding:15px; text-align:center; font-size:20px; font-weight:bold;">
                            Pengajuan Cuti Baru
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px; color:#333333; font-size:14px; line-height:1.6;">
                            <p style="margin:0 0 10px 0;">
                                Ada pengajuan <strong style="color:#222222;">{{ $cuti->nama_cuti }}</strong>
                                dari <strong>{{ $cuti->user->name }}</strong>.
                            </p>
                            <table width="100%" cellpadding="8" cellspacing="0" style="border:1px solid #ddd; border-radius:6px; margin:15px 0;">
                                <tr>
                                    <td style="background:#f9f9f9; font-weight:bold; width:100px;">Jenis Cuti</td>
                                    <td>{{ $cuti->nama_cuti }}</td>
                                </tr>
                                <tr>
                                    <td style="background:#f9f9f9; font-weight:bold;">Tanggal Mulai</td>
                                    <td>{{ $cuti->tanggal_mulai }}</td>
                                </tr>
                                <tr>
                                    <td style="background:#f9f9f9; font-weight:bold;">Tanggal Akhir</td>
                                    <td>{{ $cuti->tanggal_akhir }}</td>
                                </tr>
                                <tr>
                                    <td style="background:#f9f9f9; font-weight:bold;">Alasan</td>
                                    <td>{{ $cuti->alasan_cuti ?? '-' }}</td>
                                </tr>
                            </table>
                            <p style="margin:0;">
                                Silakan lakukan approval melalui aplikasi.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#f1f1f1; text-align:center; padding:10px; font-size:12px; color:#666;">
                            &copy; {{ date('Y') }} HRIS System - R-Tech
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

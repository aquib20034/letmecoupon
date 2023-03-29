<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:tahoma, verdana, segoe, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title>Broken Affiliate Links</title>
</head>
<body>
    <p>This is an auto-generated email to notify about the broken Affiliate links</p>
    <table id="container" style="font-family:Arial, Helvetica, sans-serif; border-collapse:collapse;width:100%">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #04AA6D; color: white;">
                    Region
                </th>
                <th style="border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #04AA6D; color: white;">
                    Store ID
                </th>
                <th style="border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #04AA6D; color: white;">
                    Store Name
                </th>
                <th style="border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #04AA6D; color: white;">
                    Store URL
                </th>
                <th style="border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #04AA6D; color: white;">
                    Affiliate URL
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $value)
        <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $value['region'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $value['store_id'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $value['store_name'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $value['store_url'] }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $value['affiliate_url'] }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>

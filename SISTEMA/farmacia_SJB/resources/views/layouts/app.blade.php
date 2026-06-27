<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'El Huerto de Don José')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f8f9fa; color: #333; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 1em; }
        textarea { resize: vertical; height: 100px; }
        .btn { padding: 10px 15px; border-radius: 4px; text-decoration: none; font-weight: bold; cursor: pointer; border: none; display: inline-block; font-size: 1em; }
        .btn-primary { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: #212529; font-size: 0.9em; padding: 5px 10px; }
        .btn-danger { background-color: #dc3545; color: white; font-size: 0.9em; padding: 5px 10px; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f1f1f1; }
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 0.85em; font-weight: bold; }
        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-danger { background-color: #f8d7da; color: #721c24; }
        .actions-form { display: inline; }
        .actions { display: flex; justify-content: flex-end; margin-top: 25px; }
        .text-danger { color: #dc3545; font-size: 0.85em; font-weight: bold; margin-top: 5px; display: block; }
    </style>
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
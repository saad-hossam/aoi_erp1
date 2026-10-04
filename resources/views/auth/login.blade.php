<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap');

    :root {
        --navy:        #1A2B6D;
        --navy-light:  #2A3F8F;
        --red:         #C1121F;
        --ink:         #0A0E1F;
        --muted:       #6B7391;
        --line:        #E4E8F3;
        --bg:          #F5F7FC;

        /* ==== ألوان البطاقة الجديدة (داكنة) ==== */
        --card-bg:      #10182B;
        --card-border:  #2A3450;
        --card-text:    #E8ECF5;
        --card-muted:   #8A94B0;
        --input-bg:     #1A2238;
        --input-border: #2E3A5A;
    }

    * { box-sizing: border-box; }
    body {
   font-family: 'Cairo', sans-serif;
            margin: 0;
            background-color: #F5F7FC; /* fallback */
            background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop'); /* transparent background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
    }

  /* overlay لضمان وضوح النص مع شفافية الصورة */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-color: rgba(245, 247, 252, 0.85); شفافية عالية مع لون الخلفية الأساسي */
            pointer-events: none; /* لا يعيق النقر */
            z-index: 0;
        }

    .simple-shell {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        position: relative;
        z-index: 1;
    }

    /* ====== البطاقة الداكنة ====== */
    .simple-card {
        width: 100%;
        max-width: 460px;
        background: var(--card-bg);
        border-radius: 16px;
        padding: 44px 40px;
        box-shadow:
            0 20px 50px -10px rgba(0, 0, 0, 0.55),
            0 0 0 1px rgba(255, 255, 255, 0.04);
        border: 1px solid var(--card-border);
        backdrop-filter: blur(4px);
    }

    /* ====== رأس البطاقة ====== */
    .simple-head { text-align: center; margin-bottom: 34px; }
    .simple-head .logo {
        width: 60px; height: 60px;
        margin: 0 auto 18px;
        border-radius: 14px;
        background: var(--navy);
        display: grid; place-items: center;
        color: #fff;
        font-weight: 800;
        font-size: 22px;
        letter-spacing: -.5px;
        box-shadow: 0 8px 20px -6px rgba(26,43,109,.5);
    }
    .simple-head h1 {
        font-size: 28px;
        font-weight: 800;
        color: var(--card-text);
        margin: 0 0 6px;
    }
    .simple-head p {
        color: var(--card-muted);
        font-size: 18px;
        margin: 0;
    }

    /* ====== الحقول ====== */
    .simple-field { margin-bottom: 18px; }
    .simple-field label {
        display: block;
        font-size: 18px;
        font-weight: 600;
        color: var(--card-text);
        margin-bottom: 8px;
    }
    .simple-field .wrap { position: relative; }

    .simple-field select,
    .simple-field input {
        width: 100%;
        height: 48px;
        border-radius: 10px;
        border: 1.5px solid var(--input-border);
        background: var(--input-bg);
        padding: 0 40px 0 14px;
        font-size: 18px;
        font-family: inherit;
        color: var(--card-text);
        outline: none;
        transition: all .2s ease;
        appearance: none;
        -webkit-appearance: none;
    }

    /* لضمان ظهور خيارات القائمة المنسدلة بشكل مقروء */
    .simple-field select option {
        background-color: var(--input-bg);
        color: var(--card-text);
    }

    .simple-field select { cursor: pointer; }
    .simple-field select:disabled {
        background: #151D30;
        color: var(--card-muted);
        cursor: not-allowed;
    }
    .simple-field select:focus,
    .simple-field input:focus {
        border-color: var(--navy-light);
        box-shadow: 0 0 0 3px rgba(42,63,143,.25);
        background: #1E2740;
    }

    .simple-field input::placeholder {
        color: #6B7391;
    }

    .simple-field .ic {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: var(--card-muted);
        font-size: 18px;
        pointer-events: none;
    }
    .simple-field .ic.end   { right: 14px; }
    .simple-field .ic.start { left: 14px; pointer-events: auto; cursor: pointer; }
    .simple-field .ic.start:hover { color: #ffffff; }

    .simple-field.select .wrap::after {
        content:'';
        position: absolute;
        left: 16px; top: 50%;
        width: 7px; height: 7px;
        border-right: 1.5px solid var(--card-muted);
        border-bottom: 1.5px solid var(--card-muted);
        transform: translateY(-70%) rotate(45deg);
        pointer-events: none;
    }

    /* ====== صف الخيارات ====== */
    .simple-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 6px 0 22px;
        font-size: 13px;
    }
    .simple-row label {
        display: inline-flex; align-items: center; gap: 8px;
        color: var(--card-muted); cursor: pointer; user-select: none;
    }
    .simple-row input[type=checkbox] {
        appearance: none;
        width: 16px; height: 16px;
        border: 1.5px solid var(--input-border);
        border-radius: 4px;
        background: var(--input-bg);
        cursor: pointer;
        position: relative;
    }
    .simple-row input[type=checkbox]:checked {
        background: var(--navy);
        border-color: var(--navy);
    }
    .simple-row input[type=checkbox]:checked::after {
        content:'';
        position: absolute;
        top: 1px; left: 5px;
        width: 4px; height: 8px;
        border-right: 1.5px solid #fff;
        border-bottom: 1.5px solid #fff;
        transform: rotate(45deg);
    }
    .simple-row a {
        color: #8A9BC0;
        text-decoration: none;
        font-weight: 600;
    }
    .simple-row a:hover { color: #ffffff; }

    /* ====== زر الدخول ====== */
    .simple-btn {
        width: 100%;
        height: 50px;
        border: 0;
        border-radius: 10px;
        background: var(--navy);
        color: #fff;
        font-family: inherit;
        font-size: 20px;
        font-weight: 700;
        cursor: pointer;
        transition: all .2s ease;
        box-shadow: 0 6px 18px -6px rgba(26,43,109,.6);
    }
    .simple-btn:hover {
        background: var(--navy-light);
        transform: translateY(-1px);
        box-shadow: 0 10px 24px -6px rgba(26,43,109,.7);
    }
    .simple-btn:active { transform: translateY(0); }

    /* ====== تذييل البطاقة ====== */
    .simple-foot {
        text-align: center;
        margin-top: 22px;
        color: var(--card-muted);
        font-size: 13px;
    }
    .simple-foot a {
        color: #8A9BC0;
        font-weight: 700;
        text-decoration: none;
        margin-right: 4px;
    }
    .simple-foot a:hover { color: #ffffff; }

    /* ====== حالات الخطأ ====== */
    .simple-field.is-invalid select,
    .simple-field.is-invalid input {
        border-color: var(--red);
    }
    .simple-err {
        display: block;
        color: #FF6B6B;
        font-size: 12px;
        margin-top: 6px;
        font-weight: 600;
    }

    @media (max-width: 500px) {
        .simple-card { padding: 32px 24px; }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
<main class='pt-90 simple-shell'>
    <div class='simple-card' dir='rtl'>

        <div class='simple-head'>
            <div class='logo'>AOI</div>
            <h1>تسجيل الدخول</h1>
            <p>المنظومة الموحدة لوحدات الهيئة العربية للتصنيع</p>
        </div>

        <form method='POST' action='{{ route('login') }}' novalidate>
            @csrf

            {{-- Unit --}}
            <div class='simple-field select {{ $errors->has('email') ? "is-invalid" : "" }}'>
                <label for='email'>الجهة / الوحدة</label>
                <div class='wrap'>
                    <select name='email' id='email' required>
                        <option value='' disabled {{ old('email') ? '' : 'selected' }}>اختر الوحدة</option>
                        @foreach ($units as $unit)
                            <option value='{{ $unit->UNIT_CODE }}' {{ old('email') == $unit->UNIT_CODE ? 'selected' : '' }}>
                                {{ $unit->UNIT_NAME }}
                            </option>
                        @endforeach
                    </select>
                    <i class='bi bi-buildings ic end'></i>
                </div>
                @error('email') <span class='simple-err'>{{ $message }}</span> @enderror
            </div>

            {{-- Employee --}}
            <div class='simple-field select {{ $errors->has('employee') ? "is-invalid" : "" }}'>
                <label for='employee'>الموظف</label>
                <div class='wrap'>
                    <select name='employee' id='employee' required disabled>
                        <option value=''>اختر الوحدة أولاً</option>
                    </select>
                    <i class='bi bi-person-badge ic end'></i>
                </div>
                @error('employee') <span class='simple-err'>{{ $message }}</span> @enderror
            </div>

            {{-- Password --}}
            <div class='simple-field {{ $errors->has('password') ? "is-invalid" : "" }}'>
                <label for='password'>كلمة المرور</label>
                <div class='wrap'>
                    <input id='password' type='password' name='password' required autocomplete='current-password' placeholder='••••••••'>
                    <i class='bi  ic start  bi-eye-slash' onclick="simpleToggle(this)"></i>
                </div>
                @error('password') <span class='simple-err'>{{ $message }}</span> @enderror
            </div>
{{-- 
            <div class='simple-row'>
                <label>
                    <input type='checkbox' name='remember'> تذكرني
                </label>
                <a href='#'>نسيت كلمة المرور؟</a>
            </div> --}}

            <button class='simple-btn' type='submit'>دخول</button>

            {{-- <div class='simple-foot'>
                ليس لديك حساب؟
                <a href='{{ route("register") }}'>إنشاء حساب</a>
            </div> --}}
        </form>
    </div>
</main>

<script>
    /* ========= Password Toggle ========= */
    function simpleToggle(el) {
        const input = el.closest('.wrap').querySelector('input');
        input.type = input.type === 'password' ? 'text' : 'password';
        el.classList.toggle('bi-eye-slash');
        el.classList.toggle('bi-eye');
    }

    /* ========= Cascading Dropdown ========= */
    document.addEventListener('DOMContentLoaded', function () {
        const unitSelect     = document.getElementById('email');
        const employeeSelect = document.getElementById('employee');

        // إذا كان هناك اختيار سابق، حمّل الموظفين تلقائيًا
        if (unitSelect.value) {
            loadEmployees(unitSelect.value);
        }

        unitSelect.addEventListener('change', function () {
            if (this.value) loadEmployees(this.value);
        });

        function loadEmployees(unitCode) {
            employeeSelect.disabled = true;
            employeeSelect.innerHTML = '<option value="">جاري التحميل...</option>';

            const url = `{{ route('login.employees') }}?unit_code=${encodeURIComponent(unitCode)}`;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                employeeSelect.innerHTML = '<option value="">اختر الموظف</option>';

                if (!data || !data.length) {
                    employeeSelect.innerHTML = '<option value="">لا يوجد موظفون في هذه الوحدة</option>';
                    return;
                }

                data.forEach(emp => {
                    const code = emp.emp_code;
                    const name = emp.emp_name;

                    if (code === undefined || code === null || code === '') return;

                    const opt = document.createElement('option');
                    opt.value       = code;
                    opt.textContent = (name && String(name).trim() !== '')
                                    ? name
                                    : `موظف #${code}`;
                    employeeSelect.appendChild(opt);
                });

                employeeSelect.disabled = false;

                // إعادة تحديد القيمة القديمة بعد فشل تسجيل الدخول
                const oldEmployee = "{{ old('employee') }}";
                if (oldEmployee) {
                    employeeSelect.value = oldEmployee;
                    if (employeeSelect.value !== oldEmployee) {
                        const opt = document.createElement('option');
                        opt.value = oldEmployee;
                        opt.textContent = `موظف #${oldEmployee}`;
                        employeeSelect.appendChild(opt);
                        employeeSelect.value = oldEmployee;
                    }
                }
            })
            .catch(err => {
                console.error('[Cascade] Error:', err);
                employeeSelect.innerHTML = '<option value="">حدث خطأ، حاول مرة أخرى</option>';
            });
        }
    });
</script>
</body>
</html>
{{-- @endsection --}}
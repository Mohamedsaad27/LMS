<?php

return [

    'accepted'             => 'يجب قبول :attribute.',
    'accepted_if'          => 'يجب قبول :attribute عندما يكون :other :value.',
    'active_url'           => ':attribute ليس رابطًا صحيحًا.',
    'after'                => 'يجب أن يكون :attribute تاريخًا بعد :date.',
    'after_or_equal'       => 'يجب أن يكون :attribute تاريخًا بعد أو يساوي :date.',
    'alpha'                => 'قد يحتوي :attribute على أحرف فقط.',
    'alpha_dash'           => 'قد يحتوي :attribute على أحرف وأرقام وشرطات وشرطات سفلية فقط.',
    'alpha_num'            => 'قد يحتوي :attribute على أحرف وأرقام فقط.',
    'array'                => 'يجب أن يكون :attribute مصفوفة.',
    'before'               => 'يجب أن يكون :attribute تاريخًا قبل :date.',
    'before_or_equal'      => 'يجب أن يكون :attribute تاريخًا قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'يجب أن يكون :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute بين :min و :max حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute بين :min و :max عنصرًا.',
    ],
    'boolean'              => 'يجب أن يكون حقل :attribute صحيحًا أو خطأ.',
    'confirmed'            => 'تأكيد :attribute غير متطابق.',
    'current_password'     => 'كلمة المرور غير صحيحة.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute تاريخًا يساوي :date.',
    'date_format'          => 'لا يتطابق :attribute مع الشكل :format.',
    'declined'             => 'يجب رفض :attribute.',
    'declined_if'          => 'يجب رفض :attribute عندما يكون :other :value.',
    'different'            => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits'               => 'يجب أن يكون :attribute :digits أرقام.',
    'digits_between'       => 'يجب أن يكون :attribute بين :min و :max أرقام.',
    'dimensions'           => ':attribute له أبعاد صورة غير صالحة.',
    'distinct'             => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالحًا.',
    'ends_with'            => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'exists'               => ':attribute المحدد غير صالح.',
    'file'                 => 'يجب أن يكون :attribute ملفًا.',
    'filled'               => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'gt'                   => [
        'numeric' => 'يجب أن يكون :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من :value حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عنصرًا.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن يكون :attribute أكبر من أو يساوي :value.',
        'file'    => 'يجب أن يكون :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أكبر من أو يساوي :value حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على :value عنصرًا أو أكثر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورة.',
    'in'                   => ':attribute المحدد غير صالح.',
    'in_array'             => 'حقل :attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صالحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صالحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صالحًا.',
    'json'                 => 'يجب أن يكون :attribute نص JSON صالحًا.',
    'lt'                   => [
        'numeric' => 'يجب أن يكون :attribute أقل من :value.',
        'file'    => 'يجب أن يكون :attribute أقل من :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أقل من :value حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عنصرًا.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن يكون :attribute أقل من أو يساوي :value.',
        'file'    => 'يجب أن يكون :attribute أقل من أو يساوي :value كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute أقل من أو يساوي :value حرفًا.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :value عنصرًا.',
    ],
    'max'                  => [
        'numeric' => 'قد لا يكون :attribute أكبر من :max.',
        'file'    => 'قد لا يكون :attribute أكبر من :max كيلوبايت.',
        'string'  => 'قد لا يكون :attribute أكبر من :max حرفًا.',
        'array'   => 'قد لا يحتوي :attribute على أكثر من :max عنصرًا.',
    ],
    'mimes'                => 'يجب أن يكون :attribute ملفًا من النوع: :values.',
    'mimetypes'            => 'يجب أن يكون :attribute ملفًا من النوع: :values.',
    'min'                  => [
        'numeric' => 'يجب أن يكون :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute على الأقل :min حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل :min عنصرًا.',
    ],
    'multiple_of'          => 'يجب أن يكون :attribute مضاعفًا لـ :value.',
    'not_in'               => ':attribute المحدد غير صالح.',
    'not_regex'            => 'تنسيق :attribute غير صالح.',
    'numeric'              => 'يجب أن يكون :attribute رقمًا.',
    'password'             => 'كلمة المرور غير صحيحة.',
    'present'              => 'يجب أن يكون حقل :attribute حاضرًا.',
    'prohibited'           => 'حقل :attribute محظور.',
    'prohibited_if'        => 'حقل :attribute محظور عندما يكون :other :value.',
    'prohibited_unless'    => 'حقل :attribute محظور ما لم يكن :other في :values.',
    'prohibits'            => 'حقل :attribute يحظر :other من التواجد.',
    'regex'                => 'تنسيق :attribute غير صالح.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_array_keys'  => 'يجب أن يحتوي حقل :attribute على إدخالات لـ: :values.',
    'required_if'          => 'حقل :attribute مطلوب عندما يكون :other :value.',
    'required_unless'      => 'حقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with'        => 'حقل :attribute مطلوب عندما يكون :values حاضرًا.',
    'required_with_all'    => 'حقل :attribute مطلوب عندما تكون :values حاضرة.',
    'required_without'     => 'حقل :attribute مطلوب عندما لا تكون :values حاضرة.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من :values حاضرة.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن يكون :attribute :size.',
        'file'    => 'يجب أن يكون :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يكون :attribute :size حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرًا.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute منطقة زمنية صالحة.',
    'unique'               => 'تم أخذ :attribute بالفعل.',
    'uploaded'             => 'فشل تحميل :attribute.',
    'url'                  => 'تنسيق :attribute غير صالح.',
    'uuid'                 => 'يجب أن يكون :attribute UUID صالحًا.',

    'custom' => [
        'phone' => [
            'unique' => 'تم أخذ رقم الهاتف بالفعل.',
            'exists' => 'رقم الهاتف المدخل  مسجل لدينا.',
        ],
        'email' => [
            'exists' => 'البريد الإلكتروني المدخل غير مسجل لدينا.',
        ],
        'user_id' => [
            'required' => 'حقل معرف المستخدم مطلوب.',
            'exists' => 'المستخدم المحدد غير صالح.',
        ],
        'publishing_house_id' => [
            'required' => 'حقل معرف دار النشر مطلوب.',
            'exists' => 'دار النشر المحددة غير صالحة.',
        ],
        'established_year' => [
            'required' => 'سنة التأسيس مطلوبة.',
            'integer' => 'يجب أن تكون سنة التأسيس عددًا صحيحًا.',
            'digits' => 'يجب أن تحتوي سنة التأسيس على 4 أرقام.',
            'min' => 'يجب أن تكون سنة التأسيس بعد 1800.',
            'max' => 'يجب أن تكون سنة التأسيس قبل أو تساوي السنة الحالية.',
        ],
        'student_count' => [
            'required' => 'عدد الطلاب مطلوب.',
            'integer' => 'يجب أن يكون عدد الطلاب عددًا صحيحًا.',
            'min' => 'يجب ألا يكون عدد الطلاب أقل من 0.',
        ],
        'teacher_count' => [
            'required' => 'عدد المعلمين مطلوب.',
            'integer' => 'يجب أن يكون عدد المعلمين عددًا صحيحًا.',
            'min' => 'يجب ألا يكون عدد المعلمين أقل من 0.',
        ],
        'logo' => [
            'image' => 'يجب أن يكون الشعار صورة.',
            'mimes' => 'يجب أن يكون الشعار من النوع: jpeg, png, jpg, gif.',
            'max' => 'حجم الشعار لا يجب أن يتجاوز 2 ميغابايت.',
        ],
        'type' => [
            'required' => 'نوع المدرسة مطلوب.',
            'in' => 'يجب أن يكون نوع المدرسة إما ابتدائية أو اعدادية او ثانوية .',
        ],
        'school_id' => [
            'exists' => 'المدرسة المحددة غير صالحة.',
        ],
        'experience_years' => [
            'required' => 'سنوات الخبرة مطلوبة.',
            'integer' => 'يجب أن يكون سنوات الخبرة عددًا صحيحًا.',
            'min' => 'يجب ألا يكون سنوات الخبرة أقل من 0.',
        ],
        'status' => [
            'required' => 'الحالة مطلوبة.',
            'in' => 'يجب أن يكون الحالة إما مفعل أو غير مفعل.',
        ],
        'photo' => [
            'image' => 'يجب أن يكون الصورة صورة.',
            'mimes' => 'يجب أن يكون الصورة من النوع: jpeg, png, jpg, gif.',
            'max' => 'حجم الصورة لا يجب أن يتجاوز 2 ميغابايت.',
        ],
        'salary' => [
            'numeric' => 'يجب أن يكون الراتب رقمًا حقيقيًا.',
        ],
        'date_of_birth' => [
            'date' => 'يجب أن يكون تاريخ الميلاد تاريخًا صالحًا.',
        ],
    ],

    'validation_errors' => 'Validation errors',

    'attributes' => [
        'attributes' => [
            'current_password'    => 'كلمة المرور الحالية',
            'new_password'        => 'كلمة المرور الجديدة',
            'email'               => 'البريد الإلكتروني',
            'password'            => 'كلمة المرور',
            'first_name'          => 'الاسم الأول',
            'last_name'           => 'الاسم الأخير',
            'gender'              => 'الجنس',
            'address'             => 'العنوان',
            'phone'               => 'رقم الهاتف',
            'verification_code'   => 'رمز التحقق',
            'code'                => 'الرمز',
            'user_id'             => ' المستخدم',
            'publishing_house_id' => ' دار النشر',
            'established_year'    => 'سنة التأسيس',
            'student_count'       => 'عدد الطلاب',
            'teacher_count'       => 'عدد المعلمين',
            'logo'                => 'الشعار',
            'type'                => 'نوع المدرسة',
            'school_id'           => 'المدرسة',
            'hire_date'           => 'تاريخ التعيين',
            'qualification'       => 'المؤهل الدراسي',
            'experience_years'    => 'سنوات الخبرة',
            'status'              => 'الحالة',
            'photo'               => 'الصورة',
            'salary'              => 'الراتب',
            'date_of_birth'       => 'تاريخ الميلاد',
        ],

    ],


];

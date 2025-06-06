PGDMP                      }            siakad    17.3    17.3 �    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            �           1262    16396    siakad    DATABASE     l   CREATE DATABASE siakad WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en-US';
    DROP DATABASE siakad;
                     postgres    false            �            1259    17634    achievements    TABLE     �  CREATE TABLE public.achievements (
    id bigint NOT NULL,
    student_id bigint NOT NULL,
    teacher_id bigint NOT NULL,
    subject character varying(255) NOT NULL,
    description text,
    achievement_date date NOT NULL,
    semester character varying(255) NOT NULL,
    academic_year character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    achievements json
);
     DROP TABLE public.achievements;
       public         heap r       postgres    false            �            1259    17633    achievements_id_seq    SEQUENCE     |   CREATE SEQUENCE public.achievements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.achievements_id_seq;
       public               postgres    false    237            �           0    0    achievements_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.achievements_id_seq OWNED BY public.achievements.id;
          public               postgres    false    236            �            1259    17541    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap r       postgres    false            �            1259    17548    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap r       postgres    false            �            1259    17748    class_rooms    TABLE     $  CREATE TABLE public.class_rooms (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    teacher_id bigint,
    academic_year character varying(255) NOT NULL,
    description text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.class_rooms;
       public         heap r       postgres    false            �            1259    17747    class_rooms_id_seq    SEQUENCE     {   CREATE SEQUENCE public.class_rooms_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.class_rooms_id_seq;
       public               postgres    false    250            �           0    0    class_rooms_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.class_rooms_id_seq OWNED BY public.class_rooms.id;
          public               postgres    false    249            �            1259    17573    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap r       postgres    false            �            1259    17572    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public               postgres    false    229            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public               postgres    false    228            �            1259    17565    job_batches    TABLE     d  CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap r       postgres    false            �            1259    17556    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap r       postgres    false            �            1259    17555    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public               postgres    false    226            �           0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public               postgres    false    225            �            1259    17508 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap r       postgres    false            �            1259    17507    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public               postgres    false    218            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public               postgres    false    217            �            1259    17691    model_has_permissions    TABLE     �   CREATE TABLE public.model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);
 )   DROP TABLE public.model_has_permissions;
       public         heap r       postgres    false            �            1259    17702    model_has_roles    TABLE     �   CREATE TABLE public.model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);
 #   DROP TABLE public.model_has_roles;
       public         heap r       postgres    false            �            1259    17525    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap r       postgres    false            �            1259    17653    payments    TABLE     h  CREATE TABLE public.payments (
    id bigint NOT NULL,
    student_id bigint NOT NULL,
    payment_type character varying(255) NOT NULL,
    amount numeric(10,2) NOT NULL,
    payment_method character varying(255),
    payment_date date NOT NULL,
    month character varying(255),
    academic_year character varying(255) NOT NULL,
    receipt_number character varying(255) NOT NULL,
    notes text,
    status character varying(255) DEFAULT 'paid'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    payment_proof character varying(255)
);
    DROP TABLE public.payments;
       public         heap r       postgres    false            �            1259    17652    payments_id_seq    SEQUENCE     x   CREATE SEQUENCE public.payments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.payments_id_seq;
       public               postgres    false    239            �           0    0    payments_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.payments_id_seq OWNED BY public.payments.id;
          public               postgres    false    238            �            1259    17670    permissions    TABLE     �   CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.permissions;
       public         heap r       postgres    false            �            1259    17669    permissions_id_seq    SEQUENCE     {   CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.permissions_id_seq;
       public               postgres    false    241            �           0    0    permissions_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;
          public               postgres    false    240            �            1259    17730    registrations    TABLE       CREATE TABLE public.registrations (
    id bigint NOT NULL,
    user_id bigint,
    name character varying(255) NOT NULL,
    registration_number character varying(255),
    birth_date date NOT NULL,
    gender character varying(255) NOT NULL,
    address text NOT NULL,
    parent_name character varying(255) NOT NULL,
    parent_phone character varying(255) NOT NULL,
    parent_email character varying(255),
    photo character varying(255),
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    rejection_reason text,
    registration_date date DEFAULT '2025-05-09'::date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT registrations_gender_check CHECK (((gender)::text = ANY ((ARRAY['male'::character varying, 'female'::character varying])::text[]))),
    CONSTRAINT registrations_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[])))
);
 !   DROP TABLE public.registrations;
       public         heap r       postgres    false            �            1259    17729    registrations_id_seq    SEQUENCE     }   CREATE SEQUENCE public.registrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.registrations_id_seq;
       public               postgres    false    248            �           0    0    registrations_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.registrations_id_seq OWNED BY public.registrations.id;
          public               postgres    false    247            �            1259    17713    role_has_permissions    TABLE     m   CREATE TABLE public.role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);
 (   DROP TABLE public.role_has_permissions;
       public         heap r       postgres    false            �            1259    17681    roles    TABLE     �   CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.roles;
       public         heap r       postgres    false            �            1259    17680    roles_id_seq    SEQUENCE     u   CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.roles_id_seq;
       public               postgres    false    243            �           0    0    roles_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;
          public               postgres    false    242            �            1259    17619 	   schedules    TABLE     1  CREATE TABLE public.schedules (
    id bigint NOT NULL,
    teacher_id bigint NOT NULL,
    subject_name character varying(255) NOT NULL,
    day_of_week character varying(255) NOT NULL,
    start_time time(0) without time zone NOT NULL,
    end_time time(0) without time zone NOT NULL,
    room character varying(255),
    class_group character varying(255) NOT NULL,
    notes text,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.schedules;
       public         heap r       postgres    false            �            1259    17618    schedules_id_seq    SEQUENCE     y   CREATE SEQUENCE public.schedules_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.schedules_id_seq;
       public               postgres    false    235            �           0    0    schedules_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.schedules_id_seq OWNED BY public.schedules.id;
          public               postgres    false    234            �            1259    17532    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap r       postgres    false            �            1259    17585    students    TABLE     v  CREATE TABLE public.students (
    id bigint NOT NULL,
    user_id bigint,
    name character varying(255) NOT NULL,
    registration_number character varying(255) NOT NULL,
    birth_date date NOT NULL,
    gender character varying(255) NOT NULL,
    address text,
    parent_name character varying(255) NOT NULL,
    parent_phone character varying(255) NOT NULL,
    photo character varying(255),
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    join_date date NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    class_room_id bigint
);
    DROP TABLE public.students;
       public         heap r       postgres    false            �            1259    17584    students_id_seq    SEQUENCE     x   CREATE SEQUENCE public.students_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.students_id_seq;
       public               postgres    false    231            �           0    0    students_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.students_id_seq OWNED BY public.students.id;
          public               postgres    false    230            �            1259    17602    teachers    TABLE       CREATE TABLE public.teachers (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    employee_id character varying(255) NOT NULL,
    specialization character varying(255),
    phone_number character varying(255) NOT NULL,
    address text,
    photo character varying(255),
    join_date date NOT NULL,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    bio text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.teachers;
       public         heap r       postgres    false            �            1259    17601    teachers_id_seq    SEQUENCE     x   CREATE SEQUENCE public.teachers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.teachers_id_seq;
       public               postgres    false    233            �           0    0    teachers_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.teachers_id_seq OWNED BY public.teachers.id;
          public               postgres    false    232            �            1259    17515    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    gender character varying(255),
    phone character varying(15),
    role character varying(255)
);
    DROP TABLE public.users;
       public         heap r       postgres    false            �            1259    17514    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public               postgres    false    220            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public               postgres    false    219            �           2604    17637    achievements id    DEFAULT     r   ALTER TABLE ONLY public.achievements ALTER COLUMN id SET DEFAULT nextval('public.achievements_id_seq'::regclass);
 >   ALTER TABLE public.achievements ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    236    237    237            �           2604    17751    class_rooms id    DEFAULT     p   ALTER TABLE ONLY public.class_rooms ALTER COLUMN id SET DEFAULT nextval('public.class_rooms_id_seq'::regclass);
 =   ALTER TABLE public.class_rooms ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    250    249    250            �           2604    17576    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    229    228    229            �           2604    17559    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    226    225    226            �           2604    17511    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    217    218    218            �           2604    17656    payments id    DEFAULT     j   ALTER TABLE ONLY public.payments ALTER COLUMN id SET DEFAULT nextval('public.payments_id_seq'::regclass);
 :   ALTER TABLE public.payments ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    238    239    239            �           2604    17673    permissions id    DEFAULT     p   ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);
 =   ALTER TABLE public.permissions ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    240    241    241            �           2604    17733    registrations id    DEFAULT     t   ALTER TABLE ONLY public.registrations ALTER COLUMN id SET DEFAULT nextval('public.registrations_id_seq'::regclass);
 ?   ALTER TABLE public.registrations ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    247    248    248            �           2604    17684    roles id    DEFAULT     d   ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);
 7   ALTER TABLE public.roles ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    243    242    243            �           2604    17622    schedules id    DEFAULT     l   ALTER TABLE ONLY public.schedules ALTER COLUMN id SET DEFAULT nextval('public.schedules_id_seq'::regclass);
 ;   ALTER TABLE public.schedules ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    235    234    235            �           2604    17588    students id    DEFAULT     j   ALTER TABLE ONLY public.students ALTER COLUMN id SET DEFAULT nextval('public.students_id_seq'::regclass);
 :   ALTER TABLE public.students ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    231    230    231            �           2604    17605    teachers id    DEFAULT     j   ALTER TABLE ONLY public.teachers ALTER COLUMN id SET DEFAULT nextval('public.teachers_id_seq'::regclass);
 :   ALTER TABLE public.teachers ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    232    233    233            �           2604    17518    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    220    219    220            �          0    17634    achievements 
   TABLE DATA           �   COPY public.achievements (id, student_id, teacher_id, subject, description, achievement_date, semester, academic_year, created_at, updated_at, achievements) FROM stdin;
    public               postgres    false    237   ��       �          0    17541    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public               postgres    false    223   :�       �          0    17548    cache_locks 
   TABLE DATA           =   COPY public.cache_locks (key, owner, expiration) FROM stdin;
    public               postgres    false    224   ��       �          0    17748    class_rooms 
   TABLE DATA           o   COPY public.class_rooms (id, name, teacher_id, academic_year, description, created_at, updated_at) FROM stdin;
    public               postgres    false    250   �       �          0    17573    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public               postgres    false    229   O�       �          0    17565    job_batches 
   TABLE DATA           �   COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
    public               postgres    false    227   l�       �          0    17556    jobs 
   TABLE DATA           c   COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
    public               postgres    false    226   ��       �          0    17508 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public               postgres    false    218   ��       �          0    17691    model_has_permissions 
   TABLE DATA           T   COPY public.model_has_permissions (permission_id, model_type, model_id) FROM stdin;
    public               postgres    false    244   ��       �          0    17702    model_has_roles 
   TABLE DATA           H   COPY public.model_has_roles (role_id, model_type, model_id) FROM stdin;
    public               postgres    false    245   �       �          0    17525    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public               postgres    false    221   X�       �          0    17653    payments 
   TABLE DATA           �   COPY public.payments (id, student_id, payment_type, amount, payment_method, payment_date, month, academic_year, receipt_number, notes, status, created_at, updated_at, payment_proof) FROM stdin;
    public               postgres    false    239   u�       �          0    17670    permissions 
   TABLE DATA           S   COPY public.permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
    public               postgres    false    241   ��       �          0    17730    registrations 
   TABLE DATA           �   COPY public.registrations (id, user_id, name, registration_number, birth_date, gender, address, parent_name, parent_phone, parent_email, photo, status, rejection_reason, registration_date, created_at, updated_at) FROM stdin;
    public               postgres    false    248   n�       �          0    17713    role_has_permissions 
   TABLE DATA           F   COPY public.role_has_permissions (permission_id, role_id) FROM stdin;
    public               postgres    false    246   ��       �          0    17681    roles 
   TABLE DATA           M   COPY public.roles (id, name, guard_name, created_at, updated_at) FROM stdin;
    public               postgres    false    243   ��       �          0    17619 	   schedules 
   TABLE DATA           �   COPY public.schedules (id, teacher_id, subject_name, day_of_week, start_time, end_time, room, class_group, notes, status, created_at, updated_at) FROM stdin;
    public               postgres    false    235   ��       �          0    17532    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public               postgres    false    222   g�       �          0    17585    students 
   TABLE DATA           �   COPY public.students (id, user_id, name, registration_number, birth_date, gender, address, parent_name, parent_phone, photo, status, join_date, created_at, updated_at, class_room_id) FROM stdin;
    public               postgres    false    231   {�       �          0    17602    teachers 
   TABLE DATA           �   COPY public.teachers (id, user_id, name, employee_id, specialization, phone_number, address, photo, join_date, status, bio, created_at, updated_at) FROM stdin;
    public               postgres    false    233   �       �          0    17515    users 
   TABLE DATA           �   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, gender, phone, role) FROM stdin;
    public               postgres    false    220   ��       �           0    0    achievements_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.achievements_id_seq', 11, true);
          public               postgres    false    236            �           0    0    class_rooms_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.class_rooms_id_seq', 1, true);
          public               postgres    false    249            �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public               postgres    false    228            �           0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public               postgres    false    225            �           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 17, true);
          public               postgres    false    217            �           0    0    payments_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.payments_id_seq', 6, true);
          public               postgres    false    238            �           0    0    permissions_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.permissions_id_seq', 106, true);
          public               postgres    false    240            �           0    0    registrations_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.registrations_id_seq', 2, true);
          public               postgres    false    247            �           0    0    roles_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.roles_id_seq', 6, true);
          public               postgres    false    242            �           0    0    schedules_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.schedules_id_seq', 4, true);
          public               postgres    false    234            �           0    0    students_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.students_id_seq', 4, true);
          public               postgres    false    230            �           0    0    teachers_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.teachers_id_seq', 5, true);
          public               postgres    false    232            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 9, true);
          public               postgres    false    219            �           2606    17641    achievements achievements_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.achievements
    ADD CONSTRAINT achievements_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.achievements DROP CONSTRAINT achievements_pkey;
       public                 postgres    false    237            �           2606    17554    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public                 postgres    false    224            �           2606    17547    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public                 postgres    false    223                       2606    17755    class_rooms class_rooms_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.class_rooms
    ADD CONSTRAINT class_rooms_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.class_rooms DROP CONSTRAINT class_rooms_pkey;
       public                 postgres    false    250            �           2606    17581    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public                 postgres    false    229            �           2606    17583 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public                 postgres    false    229            �           2606    17571    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public                 postgres    false    227            �           2606    17563    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public                 postgres    false    226            �           2606    17513    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public                 postgres    false    218            �           2606    17701 0   model_has_permissions model_has_permissions_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);
 Z   ALTER TABLE ONLY public.model_has_permissions DROP CONSTRAINT model_has_permissions_pkey;
       public                 postgres    false    244    244    244            �           2606    17712 $   model_has_roles model_has_roles_pkey 
   CONSTRAINT     }   ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);
 N   ALTER TABLE ONLY public.model_has_roles DROP CONSTRAINT model_has_roles_pkey;
       public                 postgres    false    245    245    245            �           2606    17531 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public                 postgres    false    221            �           2606    17661    payments payments_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.payments DROP CONSTRAINT payments_pkey;
       public                 postgres    false    239            �           2606    17668 '   payments payments_receipt_number_unique 
   CONSTRAINT     l   ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_receipt_number_unique UNIQUE (receipt_number);
 Q   ALTER TABLE ONLY public.payments DROP CONSTRAINT payments_receipt_number_unique;
       public                 postgres    false    239            �           2606    17679 .   permissions permissions_name_guard_name_unique 
   CONSTRAINT     u   ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);
 X   ALTER TABLE ONLY public.permissions DROP CONSTRAINT permissions_name_guard_name_unique;
       public                 postgres    false    241    241            �           2606    17677    permissions permissions_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.permissions DROP CONSTRAINT permissions_pkey;
       public                 postgres    false    241                       2606    17741     registrations registrations_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.registrations DROP CONSTRAINT registrations_pkey;
       public                 postgres    false    248                       2606    17727 .   role_has_permissions role_has_permissions_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);
 X   ALTER TABLE ONLY public.role_has_permissions DROP CONSTRAINT role_has_permissions_pkey;
       public                 postgres    false    246    246            �           2606    17690 "   roles roles_name_guard_name_unique 
   CONSTRAINT     i   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);
 L   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_name_guard_name_unique;
       public                 postgres    false    243    243            �           2606    17688    roles roles_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public                 postgres    false    243            �           2606    17627    schedules schedules_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.schedules
    ADD CONSTRAINT schedules_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.schedules DROP CONSTRAINT schedules_pkey;
       public                 postgres    false    235            �           2606    17538    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public                 postgres    false    222            �           2606    17593    students students_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.students DROP CONSTRAINT students_pkey;
       public                 postgres    false    231            �           2606    17600 ,   students students_registration_number_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_registration_number_unique UNIQUE (registration_number);
 V   ALTER TABLE ONLY public.students DROP CONSTRAINT students_registration_number_unique;
       public                 postgres    false    231            �           2606    17617 $   teachers teachers_employee_id_unique 
   CONSTRAINT     f   ALTER TABLE ONLY public.teachers
    ADD CONSTRAINT teachers_employee_id_unique UNIQUE (employee_id);
 N   ALTER TABLE ONLY public.teachers DROP CONSTRAINT teachers_employee_id_unique;
       public                 postgres    false    233            �           2606    17610    teachers teachers_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.teachers
    ADD CONSTRAINT teachers_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.teachers DROP CONSTRAINT teachers_pkey;
       public                 postgres    false    233            �           2606    17524    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public                 postgres    false    220            �           2606    17522    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public                 postgres    false    220            �           1259    17564    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public                 postgres    false    226            �           1259    17694 /   model_has_permissions_model_id_model_type_index    INDEX     �   CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);
 C   DROP INDEX public.model_has_permissions_model_id_model_type_index;
       public                 postgres    false    244    244            �           1259    17705 )   model_has_roles_model_id_model_type_index    INDEX     u   CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);
 =   DROP INDEX public.model_has_roles_model_id_model_type_index;
       public                 postgres    false    245    245            �           1259    17540    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public                 postgres    false    222            �           1259    17539    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public                 postgres    false    222            
           2606    17642 ,   achievements achievements_student_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.achievements
    ADD CONSTRAINT achievements_student_id_foreign FOREIGN KEY (student_id) REFERENCES public.students(id) ON DELETE CASCADE;
 V   ALTER TABLE ONLY public.achievements DROP CONSTRAINT achievements_student_id_foreign;
       public               postgres    false    237    4835    231                       2606    17647 ,   achievements achievements_teacher_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.achievements
    ADD CONSTRAINT achievements_teacher_id_foreign FOREIGN KEY (teacher_id) REFERENCES public.teachers(id) ON DELETE CASCADE;
 V   ALTER TABLE ONLY public.achievements DROP CONSTRAINT achievements_teacher_id_foreign;
       public               postgres    false    237    233    4841                       2606    17756 *   class_rooms class_rooms_teacher_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.class_rooms
    ADD CONSTRAINT class_rooms_teacher_id_foreign FOREIGN KEY (teacher_id) REFERENCES public.teachers(id) ON DELETE SET NULL;
 T   ALTER TABLE ONLY public.class_rooms DROP CONSTRAINT class_rooms_teacher_id_foreign;
       public               postgres    false    4841    250    233                       2606    17695 A   model_has_permissions model_has_permissions_permission_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;
 k   ALTER TABLE ONLY public.model_has_permissions DROP CONSTRAINT model_has_permissions_permission_id_foreign;
       public               postgres    false    241    4853    244                       2606    17706 /   model_has_roles model_has_roles_role_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;
 Y   ALTER TABLE ONLY public.model_has_roles DROP CONSTRAINT model_has_roles_role_id_foreign;
       public               postgres    false    4857    245    243                       2606    17662 $   payments payments_student_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.payments
    ADD CONSTRAINT payments_student_id_foreign FOREIGN KEY (student_id) REFERENCES public.students(id) ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.payments DROP CONSTRAINT payments_student_id_foreign;
       public               postgres    false    231    239    4835                       2606    17742 +   registrations registrations_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;
 U   ALTER TABLE ONLY public.registrations DROP CONSTRAINT registrations_user_id_foreign;
       public               postgres    false    220    248    4814                       2606    17716 ?   role_has_permissions role_has_permissions_permission_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;
 i   ALTER TABLE ONLY public.role_has_permissions DROP CONSTRAINT role_has_permissions_permission_id_foreign;
       public               postgres    false    241    246    4853                       2606    17721 9   role_has_permissions role_has_permissions_role_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;
 c   ALTER TABLE ONLY public.role_has_permissions DROP CONSTRAINT role_has_permissions_role_id_foreign;
       public               postgres    false    243    246    4857            	           2606    17628 &   schedules schedules_teacher_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.schedules
    ADD CONSTRAINT schedules_teacher_id_foreign FOREIGN KEY (teacher_id) REFERENCES public.teachers(id) ON DELETE CASCADE;
 P   ALTER TABLE ONLY public.schedules DROP CONSTRAINT schedules_teacher_id_foreign;
       public               postgres    false    235    4841    233                       2606    17761 '   students students_class_room_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_class_room_id_foreign FOREIGN KEY (class_room_id) REFERENCES public.class_rooms(id) ON DELETE SET NULL;
 Q   ALTER TABLE ONLY public.students DROP CONSTRAINT students_class_room_id_foreign;
       public               postgres    false    4869    250    231                       2606    17594 !   students students_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;
 K   ALTER TABLE ONLY public.students DROP CONSTRAINT students_user_id_foreign;
       public               postgres    false    231    4814    220                       2606    17611 !   teachers teachers_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.teachers
    ADD CONSTRAINT teachers_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
 K   ALTER TABLE ONLY public.teachers DROP CONSTRAINT teachers_user_id_foreign;
       public               postgres    false    4814    220    233            �   �   x�����0g�+��l'�gfVZ��2 �����K	���-��!�¡�ݮ<��>e|@�!ц�a�G��歓��qk������)_�x
~�p�8��@��۟�d�hqB��)Y�*�UR*���c�F�H�B-      �   �  x����n�8������T��ù�]�j�V���� %M��h�{_HHc���vzP���y���}��W]������m[�ޞV��~�JV�i˼\T��j˪���X,ے��z=���9����������;+���Y?�i��=��mt�=�����S�D��.3;�.�HD�x���s�yk�����3�Y���?���+�u�O����X��'�i4������D�&2��蘸�~�N��4$07�O�`M��p7%7Sؘ�������wY�F	3J�%q�S3�v��ͱ㾤�4�D�&�����MUS���64w���3����1��Rc��Hу]u:\j�&�IP?u����$A� V�P���vMD�F�"�p�rPfD�D7*1KN��M��67j0\�f����D:s���s�����kR̼�Ҡ.�0о�욕~��:w��*P�*��͹㞣P�U�gEj�.Wԡ�U ��S����e���zA��'E���Z,H��� ��
���Ix0�Jg~�{4�vS����I	`4���Ӓ2�ff�U#�Z�̈3գ�akA*3��G�����\W��� 3��L�2�e��̲�0mNK ���Q:����t&y�K�� 4��V��i`4��&�mi!�4���'�N
��4�t砯?.���D���;'����\wN� ���;'���ם��`3�t�$:��g�sR��g�sR�����)99��{L�������crL�}&'���|��|&�79) L�}&'����crL�gLNJ ��Y��2�dq��&�d5>����q�aa9̌g��pPXX
����}w�c�G��"w��dƣ�ѹ+�q���AXa
{�Im���
KU�&����B-'o�x4�)���M��ࣴ:+���x68)-'�ݚ�������f_������Ȝ�R<Ԕ5�Ѡ��Q3��XV/�N�� G��P�L4��pUZ�^v�V��m˲����|��7�@����Fpp�経�m������J�H8��tY�}� �og) � 6�� � ���r����``�� ���O � ��.N Q�Dus��6U�ʲⲻ��׺횪�wo>H���9�������Ⲙ�����wY>��	e9a<����T�r[�"x�L/(5�����=KB3�r�����$��`�
�6q8����5
n�̒CM���2K�^�}���܀M�M>�́�%d��G�~���?]յ��f=�;H!�*����y����W�L>&;�����~u���
��ͷ�>��q��Јa��S���7�dk�����+�m���J�W׏��Ç�]5�����]_y<'�D�"�������G��o���m�mݟWVD*A^*ɵ�2_�T��B�L���Ye��lE_X��[�<�Zp)�d"[>\���>p-�O����1�#,      �      x������ � �      �   <   x�3��M,O,�4�4202���ީ9��
�� !S]S]CSK+s+#lb\1z\\\ b�      �      x������ � �      �      x������ � �      �      x������ � �      �   =  x�}�ݎ� ����l�Z�eB��Q1�M��;��6��s��(����wt�IN�х�����������i�]��V��_7Cqb�IM������4[7���5ˋgr��.��؆5�I;�n��5,�
�m��n8�y���y���6��{ra�b����q��gXLR�hc��u��h뫍 T�{
��rԬ����b
&a�U���B��K��z
��r�jzN@)d5W����71j�+/Ȋ?�e�֝ͭ�ׁR��0& �=����h����19}h�f˒�y3T8� ̞�����0�DoL�� ��2��      �      x������ � �      �   8   x�3�t,(����OI�)��	-N-�4�2�*j�E���)�)Q.3,��\1z\\\ �+9      �      x������ � �      �   &  x����N�0�����0ڮ�J�t�0T��QRa�M�j�E���.��0�97������ �Z)@a�<����+����L1�A[P62k��ߊ`�$�;��r�(6��.8��}k��qD9f�����
�}8A���Cn]��d�!�u�)�j-��"��]��Ab袐Sb	G�rĬ��ˤ�)]Uyݏ#2k�I#x�ݾ��p_�Q���\��S4YLƛ'�{��: g]	#��.D�q�m\���H�q}N��qIL��Ԅe�^Tr��X��|7l�R�\����CQzJn���8��|��      �   �  x���͎�0F��y�V6` l� ���RD�M�2!2N�y�2"����iV�΁	_�G�N>us��]�ʋ��O��D|a�_�cy��*e��8y�7X�N�k�FF3{t>4'��Β����_<��o-��K�� ��p-�&	���y�(Yk�y,Ŏ�U�Bk1O�۵�dH#%ݫ��*���F���k6�;�(�U+�(�V�喓(�a�ﱏ������g3.��甘b��mj�h[*���B
�PH`�pS&D{UB�E��#�yL��y���1ܶ��~��í3�1���^��bQ$$�Ib"�d�Ad��I"�S$�/�D^�����m��ǈ�-J��ϥk�)�m��)�!�-�M��%"�<P"���;�ꗛi������8wޥ�p:�OG�9~:*�+GGs�������mX^�5�y{����W&��e:��Agos�󩳳���l+tִEG���x��tA�q+�K��i�s=U������qV�b<��η�a�꧆���+�q�ť����NWX�OXX�NYXb'-�0�6x�,�.��&/욧�<v�V���M�NaXb�1��SV�=�Ƚ[�ν�[Js����yfA�1���p�����=���F��(/�!�]{���S�z�~����"J�,�1}0�5�N��DW>�~���e|ޤK~�����r      �   !  x�u��N�0���)����ncW��!@\0�9�Z
[�tŧ��H�������GAS�> ��b���ѫh�h`�qh
�3�����I�è���e�_L��nW	�vm:�^ar�8[��"����{�ޢ����uf/��џ��q�ӌ�sF�OX�hF#�"�r�?7��R�j���8	H|6@��,�ҕzbZ�$h.�����S���]�Č�Xa�N_�;W�ٜC���7Ց-��t+�hy?���vh�8T�x���ob�Q�qr���'^z��	�1zA      �   �   x�%���0D�V1��"�������,����˺�m���.av�.z��u8�99H"B
���[c�&Ұl<H�4H�4H�� !Ab�2�L9SΔ�����:�A.N@d�%!2 ���9Ȅ�p8$h�&hƿ�{�>���B�$-綤%iI�����'���\�Ep�R�D�~�{���!v/v/S���F��G���Yk� ^�De      �   i   x���1
�0��99�P�`��,�T�H�x}�
]�7��� ,�v�c�c�]U�+���Ԑ�O������Hv%�_�+G�U�J��¼���/5D|�E<�      �   Z   x�3�4�tLO�M�)M-NI��4��21�20�44�23�J���99c�8�K2�R9��LuLu���L�LL��q��qqq %�H      �     x�-�]s�0���Wp����$ �tz�"�!+F���(��
ȯ�hwr��9s�'�Ս��2��a�$�ι�Nk�\��h}�����i���D��X�\���x���f�=kՠ�_5%�ƫ֙Ƴ6�k�G��_^ƺ5�M��}E��/M�S��yz��ڼ��U�u�A �f����AB%$������	�E�g��x!��dh�G�>��0CIG�	�����Q�s' ��}�,�F,I���ӕ/�J4Y�9A��i}�z���j9ѱ�{Ů
�����m��2���~��I��킹�>p�hY���-�y�1�fPJ#vN�@z� �g揙�Pw�ѦJ��#V���TV�nUo�1�N��5�k�g"H"��=Sܰĕwc�I�Ád1���>�Z�����1Y�;�&�s������>ճ&���^��K[g����?y|}�7��Ч�� g����?�*���L&����-%I��IO�����FE��/�-
&z�Q;Y���eX��#�����?)Э      �   y  x������0�ϓ�����8I}�4�������B�e &��֎�t�<=nAm+q�6�5�,���v?V�R�P���TĨb�����@�������\�D�Y>E��}�]K����Vɫ��.��8���(.]��wE{ꬫ	�Cm���vT��a���2o�\� #�(�\c:r��3��쎌��9�l�84�J�v������U�g�,�{�XG��,�co��0Pw~h*e"���qC�>�����C� o���]�٤o��v�����S���4�E0ZdZM/�@ƕV!T�B�P�b��[�4���v2�,����W��?�>U�{����������|�?7}��0�z�~�9֓o�s�'k�z̕k���^����N�(�	"~�=      �   �   x�M�1�0 ���� �-�0��`�YX*6PK�:xzu1&oz��q�{���tf�VA����!��9����HHF9I��j|L�����*�jq��X�n-N�gM�Ӱ��������{�{����!@vV?����ċYS�;�1��W�Z!���1l      �   �  x�}�]��0���+��v��)p��(�: ���I6��t-"(ί_7�q�lrғ�m�''��$�H�m�I��H,.2�j�!r�pa��G��5+�G�sNQ�z8�֩=�\!,�ӋI�i�~���m���=y��c8E�%MT{��jW��3�z�x�&{�#fRV�W�#%J�U�z?�3D�'h�
�2��R�DPh®u�{��3
MrhW[ע9>�E�����qbo�K2D ��Ad�UI^$�71)�v����R�j�l���t�:'Z�o�N��5|��&V1f�Щ�0j��;5�R���m|�/��ip�I<�p
�$��é�:9�I�������A�}|��;;-�G�ΣmN���˧�\� �v�
��	)2x*y*�$�f_yw�@.y;fN��1��	�n���h-]��
16�ӭٕ�8�rU�޳ڲ����O��fQ�i�D�W��t�{������N;�+;� ���v     
-- Drop les foreign key
DROP TABLE IF EXISTS public.studentclass;
DROP TABLE IF EXISTS public.classeteacher;
DROP TABLE IF EXISTS public.history;
DROP TABLE IF EXISTS public.answers;
DROP TABLE IF EXISTS public.questions;
DROP TABLE IF EXISTS public.partycode;
DROP TABLE IF EXISTS public.party;

-- Drop les tables
DROP TABLE IF EXISTS public.theme;
DROP TABLE IF EXISTS public.partystate;
DROP TABLE IF EXISTS public.class;
DROP TABLE IF EXISTS public.person;
DROP TABLE IF EXISTS public.role;

/**-- Drop des sequences
DROP SEQUENCE IF EXISTS public.user_id_seq;
DROP SEQUENCE IF EXISTS public.answers_id_seq;
DROP SEQUENCE IF EXISTS public.class_id_seq;
DROP SEQUENCE IF EXISTS public.party_id_seq;
DROP SEQUENCE IF EXISTS public.partystate_id_seq;
DROP SEQUENCE IF EXISTS public.questions_id_seq;
DROP SEQUENCE IF EXISTS public.role_id_seq;
DROP SEQUENCE IF EXISTS public.theme_id_seq;**/
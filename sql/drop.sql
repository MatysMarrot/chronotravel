-- Drop les foreign key

DROP TABLE IF EXISTS public.answers CASCADE;
DROP TABLE IF EXISTS public.questions CASCADE;
DROP TABLE IF EXISTS public.history CASCADE;
DROP TABLE IF EXISTS public.partycode CASCADE;
DROP TABLE IF EXISTS public.party CASCADE;
DROP TABLE IF EXISTS public.stat CASCADE;
DROP TABLE IF EXISTS public.playerskin CASCADE;
DROP TABLE IF EXISTS public.currentskin CASCADE;
DROP TABLE IF EXISTS public.partystudent CASCADE;
DROP TABLE IF EXISTS public.skinobject CASCADE;
DROP TABLE IF EXISTS public.skinpart CASCADE;

-- Drop les tables
DROP TABLE IF EXISTS public.theme CASCADE;
DROP TABLE IF EXISTS public.partystate CASCADE;
DROP TABLE IF EXISTS public.classteacher CASCADE;
DROP TABLE IF EXISTS public.studentclass CASCADE;
DROP TABLE IF EXISTS public.class CASCADE;
DROP TABLE IF EXISTS public.person CASCADE;
DROP TABLE IF EXISTS public.role CASCADE;

/**-- Drop des sequences
DROP SEQUENCE IF EXISTS public.user_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.answers_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.class_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.party_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.partystate_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.questions_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.role_id_seq CASCADE;
DROP SEQUENCE IF EXISTS public.theme_id_seq CASCADE;**/
USE [SIAM_ARISA_P01]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_add_ibg_user]    Script Date: 10/03/2022 1:12:04 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- [wiss_sa_add_ibg_user]
-- Created by : Satit Po
-- Created date : 10-03-2022
-- UPDATEd date : 10-03-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_add_ibg_user]
    @emp_id varchar(8),
    @username varchar(30),
    @name varchar(30),
    @surname varchar(30),
    @level varchar(30),
    @sect_id varchar(30),
    @email varchar(30),
    @role int
WITH EXEC AS CALLER
AS
BEGIN
    SET NOCOUNT ON;

-- =========================================================
-- DECARE VARAIBLE
-- =========================================================
    BEGIN
  		DECLARE @createby		    VARCHAR(255)		= 'WISS'
  		DECLARE	@createdate		    VARCHAR(8)			= CONVERT (VARCHAR (8), GETDATE (), 112)
  		DECLARE	@createtime		    VARCHAR(6)			= REPLACE(CONVERT(VARCHAR(8),GETDATE(),108), ':','')
  		DECLARE @compcode           VARCHAR(255)		= 'J614'
        DECLARE @plantcode          VARCHAR(255)		= 'JT'
        DECLARE @rowid              int                 = 0
	    DECLARE @grouptype          VARCHAR(255)        = ''
	    DECLARE @groupcode          VARCHAR(255)        = ''
	    DECLARE @rolecode           VARCHAR(255)        = ''
        DECLARE @msguser            VARCHAR(255)        = 'Inserting user'
        DECLARE @msgusergroup       VARCHAR(255)        = 'Inserting user group'     
        DECLARE @message            VARCHAR(255)		= ''       
        DECLARE @password           VARCHAR(255)		= 'init123'        
    END

-- =========================================================
-- CHECK INSERT OR UPDATE
-- =========================================================
SELECT @rowid = GBTMLOGUSERRID FROM GBTMLOGUSER WHERE EMPCODE = @emp_id
IF @@ROWCOUNT > 0
BEGIN
-- =========================================================
-- CASE#1 UPDATE
-- =========================================================
    SET @msguser = 'Updating user';
    UPDATE GBTMLOGUSER
    SET
        USERNAME        = @username
        , EMAIL         = @email
        , ENNAME        = @name
        , ENLASTNAME    = @surname
        , [LEVEL]       = @level
        , SECCODE       = @sect_id
        , EDITBY        = @createby
        , EDITDATE      = @createdate
        , EDITTIME      = @createtime
        WHERE 
            GBTMLOGUSERRID = @rowid
    END
ELSE
-- =========================================================
-- CASE#2 INSERT
-- =========================================================
BEGIN
    INSERT INTO GBTMLOGUSER (
        EMPCODE
        ,USERNAME
        ,[PASSWORD]
        ,EMPPWDCODE
        ,FINGER1
        ,FINGER2
        ,DOMAIN
        ,EMAIL
        ,ISLOGIN
        ,ISNG
        ,ISACTIVE
        ,ISAUTOLOGON
        ,PWDCHANGE
        ,PWDEXPIREDATE
        ,PWDEXPIRETIME
        ,LASTCHANGEPWDDATE
        ,LASTCHANGEPWDTIME
        ,LASTLOGINDATE
        ,LASTLOGINTIME
        ,ENTITLE
        ,ENNAME
        ,ENMIDDLE
        ,ENLASTNAME
        ,ENGENDER
        ,ENNICKNAME
        ,NDTITLE
        ,NDNAME
        ,NDMIDDLE
        ,NDLASTNAME
        ,NDGENDER
        ,NDNICKNAME
        ,RDTITLE
        ,RDNAME
        ,RDMIDDLE
        ,RDLASTNAME
        ,RDGENDER
        ,RDNICKNAME
        ,[LEVEL]
        ,POSITIONCODE
        ,POSITIONNAME
        ,LOCATIONCODE
        ,FACTORYCODE
        ,AREACODE
        ,SECCODE
        ,ADDRESS1
        ,ADDRESS2
        ,ADDRESS3
        ,ADDRESS4
        ,ADDRESS5
        ,ZIPCODE
        ,COUNTRYCODE
        ,EMPIMAGE
        ,EMPSIGNATURE
        ,EXTEMAIL
        ,MOBILE
        ,TELEPHONE
        ,EXT
        ,ISISSTAFF
        ,[DESCRIPTION]
        ,COMPCODE
        ,PLANTCODE
        ,STATUS
        ,[ENABLE]
        ,CREATEBY
        ,CREATEDATE
        ,CREATETIME
        ,EDITBY
        ,EDITDATE
        ,EDITTIME
        ,COMMENT1
        ,COMMENT2
        ,COMMENT3
        ,COMMENT4
        ,COMMENT5
        ,NUMERIC1
        ,NUMERIC2
        ,TEXT1
        ,TEXT2
        ) VALUES (
        @emp_id  -- EMPCODE - varchar(8)
        ,@username  -- USERNAME - varchar(255)
        ,@password -- PASSWORD - varchar(255)
        ,NULL -- EMPPWDCODE - varchar(255)
        ,NULL -- FINGER1 - varchar(1024)
        ,NULL -- FINGER2 - varchar(1024)
        ,'SIAMAISIN.CO.TH' -- DOMAIN - varchar(20)
        ,@email -- EMAIL - varchar(255)
        ,'N' -- ISLOGIN - varchar(2)
        ,'N' -- ISNG - varchar(2)
        ,'Y' -- ISACTIVE - varchar(2)
        ,'Y' -- ISAUTOLOGON - varchar(2)
        ,'Y' -- PWDCHANGE - varchar(2)
        ,NULL -- PWDEXPIREDATE - varchar(8)
        ,NULL -- PWDEXPIRETIME - varchar(6)
        ,NULL -- LASTCHANGEPWDDATE - varchar(8)
        ,NULL -- LASTCHANGEPWDTIME - varchar(6)
        ,NULL -- LASTLOGINDATE - varchar(8)
        ,NULL -- LASTLOGINTIME - varchar(6)
        ,NULL -- ENTITLE - varchar(255)
        ,@name -- ENNAME - varchar(255)
        ,NULL -- ENMIDDLE - varchar(255)
        ,@surname -- ENLASTNAME - varchar(255)
        ,NULL -- ENGENDER - varchar(255)
        ,NULL -- ENNICKNAME - varchar(255)
        ,NULL -- NDTITLE - varchar(255)
        ,NULL -- NDNAME - varchar(255)
        ,NULL -- NDMIDDLE - varchar(255)
        ,NULL -- NDLASTNAME - varchar(255)
        ,NULL -- NDGENDER - varchar(255)
        ,NULL -- NDNICKNAME - varchar(255)
        ,NULL -- RDTITLE - varchar(255)
        ,NULL -- RDNAME - varchar(255)
        ,NULL -- RDMIDDLE - varchar(255)
        ,NULL -- RDLASTNAME - varchar(255)
        ,NULL -- RDGENDER - varchar(255)
        ,NULL -- RDNICKNAME - varchar(255)
        ,@level -- LEVEL - varchar(20)
        ,'PO000009' -- POSITIONCODE - varchar(20)
        ,'Leader' -- POSITIONNAME - varchar(255)
        ,'SA' -- LOCATIONCODE - varchar(20)
        ,'Factory 2' -- FACTORYCODE - varchar(20)
        ,'Office 2' -- AREACODE - varchar(20)
        ,@sect_id -- SECCODE - varchar(20)
        ,NULL -- ADDRESS1 - varchar(255)
        ,NULL -- ADDRESS2 - varchar(255)
        ,NULL -- ADDRESS3 - varchar(255)
        ,NULL -- ADDRESS4 - varchar(255)
        ,NULL -- ADDRESS5 - varchar(255)
        ,NULL -- ZIPCODE - varchar(20)
        ,NULL -- COUNTRYCODE - varchar(20)
        ,NULL -- EMPIMAGE - image
        ,NULL -- EMPSIGNATURE - image
        ,NULL -- EXTEMAIL - varchar(255)
        ,'0897811900' -- MOBILE - varchar(20)
        ,'037270100' -- TELEPHONE - varchar(20)
        ,'2132' -- EXT - varchar(20)
        ,'M' -- ISISSTAFF - varchar(2)
        ,NULL -- DESCRIPTION - varchar(255)
        ,@compcode -- COMPCODE - varchar(20)
        ,@plantcode -- PLANTCODE - varchar(20)
        ,'Y' -- STATUS - varchar(255)
        ,'Y' -- ENABLE - varchar(255)
        ,@createby -- CREATEBY - varchar(255)
        ,@createdate -- CREATEDATE - varchar(8)
        ,@createtime -- CREATETIME - varchar(6)
        ,@createby -- EDITBY - varchar(255)
        ,@createdate -- EDITDATE - varchar(8)
        ,@createtime -- EDITTIME - varchar(6)
        ,NULL -- COMMENT1 - varchar(255)
        ,NULL -- COMMENT2 - varchar(255)
        ,NULL -- COMMENT3 - varchar(255)
        ,NULL -- COMMENT4 - varchar(255)
        ,NULL -- COMMENT5 - varchar(255)
        ,0 -- NUMERIC1 - numeric(18, 4)
        ,0 -- NUMERIC2 - numeric(18, 4)
        ,NULL -- TEXT1 - varchar(1023)
        ,NULL -- TEXT2 - varchar(1023)
        )
END

-- =========================================================
-- CASE ROLE
-- =========================================================
IF (@role = 1)
    BEGIN
        SET @grouptype = 'GT_FI_IBG_USER'
        SET @groupcode = 'UG_FI_IBG_USR'
        SET @rolecode = 'RL_FI_IBG_USR'
    END
    ELSE IF (@role = 2)
    BEGIN
        SET @grouptype = 'GT_FI_IBG_USER'
        SET @groupcode = 'UG_FI_IBG_ADM'
        SET @rolecode = 'RL_FI_IBG_ADM'
    END
    ELSE IF (@role = 3)
    BEGIN
        SET @grouptype = 'GT_FI_IBG_ADMIN'
        SET @groupcode = 'UG_FI_IBG_CP_USR'
        SET @rolecode = 'RL_FI_IBG_CP_USR'
    END
    ELSE IF (@role = 4)
    BEGIN
        SET @grouptype = 'GT_FI_IBG_ADMIN'
        SET @groupcode = 'UG_FI_IBG_CP_ADM'
        SET @rolecode = 'RL_FI_IBG_CP_ADM'
    END
    ELSE
    BEGIN
        SET @grouptype = ''
        SET @groupcode = ''
        SET @rolecode = ''
    END

-- =========================================================
-- CHECK USER GROUP
-- =========================================================
SELECT @rowid = GBTMUSRGRPXRID FROM GBTMUSRGRPX WHERE EMPCODE = @emp_id
IF @@ROWCOUNT > 0
    BEGIN
        SET @msgusergroup       = 'Updating user group';
-- =========================================================
-- CASE#1 UPDATE
-- =========================================================
        UPDATE GBTMUSRGRPX
            SET GRPTYPECODE     = @grouptype
            , USRGRPCODE        = @groupcode
            , ROLECODE          = @rolecode
            , [ENABLE]          = 'Y'
            , EDITBY            = @createby
            , EDITDATE          = @createdate
            , EDITTIME          = @createtime
        WHERE 
            GBTMUSRGRPXRID = @rowid
    END
ELSE
BEGIN
-- =========================================================
-- CASE#2 INSERT
-- =========================================================
    INSERT INTO GBTMUSRGRPX (
        EMPCODE
        ,GRPTYPECODE
        ,USRGRPCODE
        ,ROLECODE
        ,[DESCRIPTION]
        ,COMPCODE
        ,PLANTCODE
        ,STATUS
        ,[ENABLE]
        ,CREATEBY
        ,CREATEDATE
        ,CREATETIME
        ,EDITBY
        ,EDITDATE
        ,EDITTIME
        ,COMMENT1
        ,COMMENT2
        ,COMMENT3
        ,COMMENT4
        ,COMMENT5
        ,NUMERIC1
        ,NUMERIC2
        ,TEXT1
        ,TEXT2
    ) VALUES (
        @emp_id  -- EMPCODE - varchar(6)
        ,@grouptype  -- GRPTYPECODE - varchar(20)
        ,@groupcode -- USRGRPCODE - varchar(20)
        ,@rolecode -- ROLECODE - varchar(20)
        ,NULL -- DESCRIPTION - varchar(255)
        ,@compcode -- COMPCODE - varchar(20)
        ,@plantcode -- PLANTCODE - varchar(20)
        ,'Y' -- STATUS - varchar(255)
        ,'Y' -- ENABLE - varchar(255)
        ,@createby -- CREATEBY - varchar(255)
        ,@createdate -- CREATEDATE - varchar(8)
        ,@createtime -- CREATETIME - varchar(6)
        ,@createby -- EDITBY - varchar(255)
        ,@createdate -- EDITDATE - varchar(8)
        ,@createtime -- EDITTIME - varchar(6)
        ,NULL -- COMMENT1 - varchar(255)
        ,NULL -- COMMENT2 - varchar(255)
        ,NULL -- COMMENT3 - varchar(255)
        ,NULL -- COMMENT4 - varchar(255)
        ,NULL -- COMMENT5 - varchar(255)
        ,0 -- NUMERIC1 - numeric(18, 4)
        ,0 -- NUMERIC2 - numeric(18, 4)
        ,NULL -- TEXT1 - varchar(1023)
        ,NULL -- TEXT2 - varchar(1023)
    )
END
-- =========================================================
-- PREPARE RETURN MESSAGE
-- =========================================================

    SET @message =  @msgusergroup + ' and ' + @msguser + ' completely. Emp id: ' + @emp_id + ', Username: ' + @username + ', Level: ' + @level + ', Section id: ' + @sect_id + ', Email: ' + @email + ' and Role: ' + @rolecode

-- =========================================================
-- RETURN OUTPUT
-- =========================================================
    SELECT 'true' AS status, @message AS message;
END

--exec wiss_sa_add_ibg_user '9999', 'satit_po', 'satit','pongpimol','LV0040','A100','satit_po@aisin-ap.com',1
--level LV0040: <Section, LV0050:Section Mgr, LV0060:Dept Mgr, LV0070:Div Mgr, LV0080:DMD, LV0090:MD
--role: 1) Normal user read only 2) Nomal user can edit 3) CP user read only 4) CP user can edit

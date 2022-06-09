USE [SIAM_ARISA_P01]
GO
/****** Object:  StoredProcedure [dbo].[add_ibg_dept]    Script Date: 10/03/2022 12:06:23 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- Created by : Satit
-- Created date : 10-03-2022
-- Updated date : 10-03-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_add_ibg_dept]
    @emp_id varchar(8),
    @dept_code varchar(30),
    @is_readonly varchar(2)
WITH EXEC AS CALLER
AS
BEGIN
    SET NOCOUNT ON;

-- =========================================================
-- DECARE VARAIBLE
-- =========================================================
  	DECLARE @createby		VARCHAR(255)		= 'admin'
  	DECLARE	@createdate		VARCHAR(8)			= CONVERT (VARCHAR (8), GETDATE (), 112)
  	DECLARE	@createtime		VARCHAR(6)			= REPLACE(CONVERT(VARCHAR(8),GETDATE(),108), ':','')
  	DECLARE @compcode       VARCHAR(255)		= 'J614'
    DECLARE @plantcode      VARCHAR(255)		= 'JT'
    DECLARE @rowid          int                 = 0
    DECLARE @isupdate       bit		            = 0
    DECLARE @message        VARCHAR(255)		= ''


-- =========================================================
-- READ ONLY = Y OR NO ONLY
-- =========================================================
	IF @is_readonly <> 'Y' BEGIN set @is_readonly = 'N' END

-- =========================================================
-- CHECK INSERT OR UPDATE
-- =========================================================
    SELECT @rowid = FITMDEPRESSRID FROM FITMDEPRESS WHERE EMPCODE = @emp_id AND DEPCODE = @dept_code
    IF @@ROWCOUNT > 0
    BEGIN
-- =========================================================
-- CASE#1: UPDATE
-- =========================================================
        SET @isupdate = 1;
        UPDATE FITMDEPRESS SET
            DEPCODE     = @dept_code,
            STATUS      = 'Y',
            [ENABLE]    = 'Y',
            COMMENT1    = @is_readonly,
            EDITBY      = @createby,
            EDITDATE    = @createdate,
            EDITTIME    = @createtime,
            TEXT1       = 'Updated by Wiss'
        WHERE
            EMPCODE = @emp_id and
            DEPCODE = @dept_code
    END
    ELSE
    BEGIN
-- =========================================================
-- CASE:2 INSERT
-- =========================================================
        INSERT INTO FITMDEPRESS(
            EMPCODE
            ,DEPCODE
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
            @emp_id         -- EMPCODE - varchar(20)
            ,@dept_code     -- DEPCODE - varchar(10)
            ,''             -- DESCRIPTION - varchar(255)
            ,@compcode      -- COMPCODE - varchar(20)
            ,@plantcode     -- PLANTCODE - varchar(20)
            ,'Y'            -- STATUS - varchar(255)
            ,'Y'            -- ENABLE - varchar(255)
            ,@createby      -- CREATEBY - varchar(255)
            ,@createdate    -- CREATEDATE - varchar(8)
            ,@createtime    -- CREATETIME - varchar(6)
            ,@createby      -- EDITBY - varchar(255)
            ,@createdate    -- EDITDATE - varchar(8)
            ,@createtime    -- EDITTIME - varchar(6)
            ,@is_readonly   -- COMMENT1 - varchar(255)
            ,NULL           -- COMMENT2 - varchar(255)
            ,NULL           -- COMMENT3 - varchar(255)
            ,NULL           -- COMMENT4 - varchar(255)
            ,NULL           -- COMMENT5 - varchar(255)
            ,0              -- NUMERIC1 - numeric(18, 4)
            ,0              -- NUMERIC2 - numeric(18, 4)
            ,'Inserted by Wiss'          -- TEXT1 - varchar(1023)
            ,NULL           -- TEXT2 - varchar(1023)
        )
    END

-- =========================================================
-- PREPARE RETURN MESSAGE
-- =========================================================
    IF @isupdate = 1 BEGIN set @message = 'Updating dept completed. Emp code: '  + @emp_id + ', Dept code: ' + @dept_code + ', Read Only: ' + @is_readonly END
    ELSE BEGIN set @message = 'Registering dept completed. Emp code: '           + @emp_id + ', Dept code: ' + @dept_code + ', Read Only: ' + @is_readonly END

-- =========================================================
-- RETURN OUTPUT
-- =========================================================
    SELECT 'true' AS status, @message AS message;
END

--EXEC wiss_sa_add_ibg_dept '999','A100','N';

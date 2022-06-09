USE [SIAM_ARISA_P01]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_emfg_add_shelf]    Script Date: 21/03/2022 5:14:47 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_atac_emfg_add_model]
-- Created by : Nuttawut
-- Created date : 16-03-2022
-- Updated date : 16-03-2022
-- =========================================================
ALTER PROCEDURE[dbo].[wiss_sa_emfg_add_shelf]
@sloc_code	VARCHAR(255)    ='',
@shelf_name	VARCHAR(255)	='',
@shelf_code	VARCHAR(20)		=''

AS
DECLARE @UPDATEDATE		VARCHAR(8)  =FORMAT(GETDATE(),'yyyyMMdd')
DECLARE	@UPDATETIME		VARCHAR(6)  =FORMAT(GETDATE(),'HHmmss')
DECLARE @USERNAME VARCHAR(255)      ='ADMIN_WISS'
DECLARE @COMPCODE VARCHAR(255)      ='J614'
DECLARE @PLANTCODE VARCHAR(255)     ='JT'
DECLARE @STATUS VARCHAR(255)        ='Y'
DECLARE @ENABLE VARCHAR(255)        ='Y'
DECLARE @NEWID int =0
DECLARE @MESSAGE VARCHAR(1024)      =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'


BEGIN TRY
BEGIN
    SET NOCOUNT ON;
    INSERT INTO   [SIAM_ARISA_P01].[dbo].[GBTMSHELFCD]
    ([SHELFCODE]
        ,[SHELFNAME]
        ,[SLOCCODE]
        ,[BOXBALANCE]
        ,[BOXMAX]
        ,[BOXMIN]
        ,[BOXTOTAL]
        ,[PCSBALANCE]
        ,[PCSMAX]
        ,[DESCRIPTION]
        ,[COMPCODE]
        ,[PLANTCODE]
        ,[STATUS]
        ,[ENABLE]
        ,[CREATEBY]
        ,[CREATEDATE]
        ,[CREATETIME]
        ,[EDITBY]
        ,[EDITDATE]
        ,[EDITTIME]
        ,[COMMENT1]
        ,[COMMENT2]
        ,[COMMENT3]
        ,[COMMENT4]
        ,[COMMENT5]
        ,[NUMERIC1]
        ,[NUMERIC2]
        ,[TEXT1]
        ,[TEXT2])

    VALUES(

    @shelf_code
        ,@shelf_name
        , @sloc_code
        ,0
        ,0
        ,0
        ,0
        ,0
        ,0
        ,''
            ,@COMPCODE
        ,@PLANTCODE
        ,@STATUS
        ,@ENABLE
        ,@USERNAME
        ,@UPDATEDATE
        ,@UPDATETIME
        ,@USERNAME
        ,@UPDATEDATE
        ,@UPDATETIME
        ,''
        ,''
        ,''
        ,''
        ,''
        ,0
        ,0
        ,''
        ,'')
	    SET  @NEWID = @@IDENTITY
		IF @NEWID >0
		BEGIN
		    SET @MESSAGE ='REGISTERING NEW SHELF : '+  @shelf_code +'/' +@shelf_name   +'  COMPLETED.'
			SET @SPSTATUS ='true'
		END
        ELSE
		BEGIN
			SET @MESSAGE ='REGISTERING NEW MODEL : '+  @shelf_code +'/' +@shelf_name   +'  FAILED.'
			SET @SPSTATUS ='false'
		END

-- RETURN MESSAGE
SELECT @SPSTATUS AS status, @MESSAGE AS message; END

	
END TRY
BEGIN CATCH
		SET @SPSTATUS ='false'

	    SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
END CATCH


-- USE SIAM_ARISA_P01
-- EXEC	wiss_atac_emfg_add_shelf @sloc_code ='SARSE5200',@shelf_name = 'T999', @shelf_code = 'T999'

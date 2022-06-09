USE [ATAC_ARISA_P02]
GO
/****** Object:  StoredProcedure [dbo].[wiss_atac_emfg_add_model]    Script Date: 3/16/2022 10:01:23 PM ******/
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
ALTER PROCEDURE[dbo].[wiss_atac_emfg_add_model]
 @model_code varchar(50) ='',
 @model_name varchar(50) ='',
 @pdt_grp_code varchar(50) =''

AS
DECLARE @DATEUPDATE VARCHAR(8)
DECLARE @TIMEUPDATE VARCHAR(6)
DECLARE @USERNAME VARCHAR(255)  ='ADMIN'
DECLARE @COMPCODE VARCHAR(255)  ='J631'
DECLARE @PLANTCODE VARCHAR(255)  ='JC'
DECLARE @STATUS VARCHAR(255)  ='Y'
DECLARE @ENABLE VARCHAR(255)  ='Y'
DECLARE @NEWID int =0
DECLARE @MESSAGE VARCHAR(MAX) =''
DECLARE @SPSTATUS VARCHAR(10) ='FALSE'

SET @DATEUPDATE =FORMAT(GETDATE(),'yyyyMMdd')
SET @TIMEUPDATE =FORMAT(GETDATE(),'HHmmss')

BEGIN TRY
	BEGIN
    SET NOCOUNT ON;
			INSERT INTO [ATAC_ARISA_P02].[DBO].[GBTMMODELXX]
			([MODELCODE]
			      ,[MODELNAME]
			      ,[DESCRIPTION]
			      ,[PDTGRPCODE]
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
			      ,[TEXT2]) VALUES(
			       @model_code
			      ,@model_name
			      ,''
			      ,@pdt_grp_code
			      ,@CompCode
			      ,@PlantCode
			      ,@status
			      ,@enable
			      ,@Username
			      ,@DATEUPDATE
			      ,@TIMEUPDATE
			      ,@Username
			      ,@DATEUPDATE
			      ,@TIMEUPDATE
			      ,''
			      ,''
			      ,''
			      ,''
				  ,''
			      ,0
			      ,0
			      ,''
			      ,'' )
    SET  @NEWID = @@IDENTITY
    IF @NEWID > 0
    BEGIN
        SET @MESSAGE ='REGISTERING NEW MODEL : '+  @model_code +'/' +@model_name   +'  COMPLETED.'
        SET @SPSTATUS ='true'
    END
    ELSE
    BEGIN
        SET @MESSAGE ='REGISTERING NEW MODEL : '+  @model_code +'/' +@model_name   +'  FAILED.'
        SET @SPSTATUS ='false'
    END
	-- Return Query
    SELECT @SPSTATUS AS status, @MESSAGE AS message; END

END TRY
BEGIN CATCH
	SET @SPSTATUS ='false'
	-- Return Query
	SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
END CATCH

-- USE ATAC_ARISA_P02
-- EXEC wiss_atac_emfg_add_model @model_code = 'MD00000170', @model_name ='TCC [D41E]', @pdt_grp_code = 'PG00000001'

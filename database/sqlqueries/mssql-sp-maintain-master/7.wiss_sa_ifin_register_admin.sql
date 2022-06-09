USE [SIAM_LASER_P01]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_ifin_register_admin]    Script Date: 18/05/2022 3:48:10 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_sa_ifin_register_admin]
-- Created by : Nuttawut
-- Created date : 17-03-2022
-- Updated date : 17-03-2022
-- GROUPCODE [ CP01 =CP ADMIN
--             CP02 = FINANCE ADMIN
--             CP03 = ACCOUNTING ADMIN
-- =========================================================
ALTER PROCEDURE[dbo].[wiss_sa_ifin_register_admin]
 @group_code varchar(50) ='',
 @username varchar(50) =''
AS
DECLARE @UPDATETIME DATETIME
DECLARE @TIMEUPDATE VARCHAR(6)
DECLARE @UPDATEBY VARCHAR(255)      ='ADMIN'
DECLARE @COMPCODE VARCHAR(255)      ='J614'
DECLARE @PLANTCODE VARCHAR(255)     ='JT'
DECLARE @STATUS VARCHAR(255)        ='Y'
DECLARE @ENABLE VARCHAR(255)        ='Y'
DECLARE @NEWID int                  =0
DECLARE @MESSAGE VARCHAR(MAX)       =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'
DECLARE @RID int =                  0
DECLARE @CURRENTSTEP VARCHAR(255)   =''
DECLARE @NEWSTEP VARCHAR(255)       =''
SET @UPDATETIME                     =GETDATE()
BEGIN TRY
	-- ===========================================================
    -- NO COUNT FOR UPDATE, INSERT, DELETE
    -- ===========================================================
    SET NOCOUNT ON;

insert into  [SIAM_LASER_P01].[dbo].[WFTMWFGRPXL]

( [STAGEGROUPCODE]
      ,[USERNAME]
      ,[DESCRIPTION]
      ,[COMPCODE]
      ,[PLANTCODE]
      ,[STATUS]
      ,[ENABLE]
      ,[CREATEBY]
      ,[CREATETIME]
      ,[EDITBY]
      ,[EDITTIME]
      ,[COMMENT1]
      ,[COMMENT2]
      ,[COMMENT3]
      ,[COMMENT4]
      ,[COMMENT5]
      ,[NUMERIC1]
      ,[NUMERIC2]
      ,[TEXT1]
      ,[TEXT2]
)
values(
	   @group_code
      ,@username
      ,''
      ,@COMPCODE
      ,@PLANTCODE
      ,@STATUS
      ,@ENABLE
      ,@UPDATEBY
      ,@UPDATETIME
      ,@UPDATEBY
      ,@UPDATETIME
      ,''
      ,''
      ,''
      ,''
      ,''
      ,0
      ,0
      ,''
      ,''
)

    SET @MESSAGE ='REGISTER NEW ADMIN, USERNAME : '+  @username  +' ,ROLE '+ @group_code +'  COMPLETED.'
    SET @SPSTATUS ='true'
    SELECT @SPSTATUS AS status,@MESSAGE AS message

END TRY
BEGIN CATCH
		SET @SPSTATUS ='false'
	    SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
END CATCH

--SELECT * FROM [WFTMWFGRPXL] ORDER BY  [WFTMWFGRPXLRID]  DESC
--DELETE [WFTMWFGRPXL] WHERE  [WFTMWFGRPXLRID]  = 1049

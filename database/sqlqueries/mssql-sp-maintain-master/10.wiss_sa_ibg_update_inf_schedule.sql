USE [SIAM_ARISA_P01]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_ibg_update_inf_schedule]    Script Date: 18/05/2022 3:42:10 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- Created by : nattawut jaidee
-- Created date : 21-03-2022
-- Updated date : 21-03-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_ibg_update_inf_schedule]
    @fiscal_year varchar(4),
    @period int,
    @inf_date varchar(8),
    @inf_time varchar(6)



AS

    SET NOCOUNT ON;

-- =========================================================
-- DECARE VARAIBLE
-- =========================================================
DECLARE @UPDATEDATE		VARCHAR(8)  =FORMAT(GETDATE(),'yyyyMMdd')
DECLARE	@UPDATETIME		VARCHAR(6)  =FORMAT(GETDATE(),'HHmmss')
DECLARE @USERNAME VARCHAR(255)      ='ADMIN_WISS'
DECLARE @COMPCODE VARCHAR(255)      ='J614'
DECLARE @PLANTCODE VARCHAR(255)     ='JT'
DECLARE @STATUS VARCHAR(255)        =''
DECLARE @ENABLE VARCHAR(255)        ='Y'
DECLARE @NEWID int =0
DECLARE @MESSAGE VARCHAR(1024)      =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'

 DECLARE @monthname VARCHAR(4) =''

 SELECT @monthname = CASE

 WHEN @period=1  THEN 'Apr'
 WHEN @period=2  THEN 'May'
 WHEN @period=3  THEN 'Jun'
 WHEN @period=4  THEN 'Jul'
 WHEN @period=5  THEN 'Aug'
 WHEN @period=6  THEN 'Sep'
 WHEN @period=7  THEN 'Oct'
 WHEN @period=8  THEN 'Nov'
 WHEN @period=9  THEN 'Dec'
 WHEN @period=10 THEN 'Jan'
 WHEN @period=11 THEN 'Feb'
 WHEN @period=12 THEN 'Mar' END


BEGIN TRY
BEGIN
  insert into [SIAM_ARISA_P01].[dbo].[FITMSCDLINF]
  (
       [INFDATE]
      ,[INFTIME]
      ,[FYEAR]
      ,[PERIOD]
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
      ,[TEXT2]
  )
  VALUES
  ( @inf_date
      ,@inf_time
      ,@fiscal_year
      ,FORMAT(@period ,'0#')
      ,@monthname
      ,@compcode
      ,@plantcode
      ,@status
      ,@enable
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
      ,''
)
 	    SET  @NEWID = @@IDENTITY
		IF @NEWID >0
		BEGIN
		    SET @MESSAGE ='create scdedule interface actual data to IBG  , Fiscal year : '+  @fiscal_year +',Period :' +FORMAT(@period,'0#')   +' , Interface date :'+ @inf_date+' , Interface time :'+@inf_time +'  COMPLETED.'
			SET @SPSTATUS ='true'
		END
        ELSE
		BEGIN
			SET @MESSAGE ='create scdedule interface actual data to IBG  , Fiscal year : '+  @fiscal_year +',Period :' +FORMAT(@period,'0#')   +' , Interface date :'+ @inf_date+' , Interface time :'+@inf_time +'  FAILED.'
			SET @SPSTATUS ='false'
		END


SELECT @SPSTATUS AS status, @MESSAGE AS message; END


END TRY
BEGIN CATCH
		SET @SPSTATUS ='false'

	    SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
END CATCH
--SELECT * FROM [SIAM_ARISA_P01].[dbo].[FITMSCDLINF] ORDER BY  [FITMSCDLINFRID] DESC
--DELETE  [SIAM_ARISA_P01].[dbo].[FITMSCDLINF] WHERE FITMSCDLINFRID   IN( 1840,1830)


-- USE SIAM_ARISA_P01
-- EXEC	@return_value = [dbo].[wiss_sa_ibg_update_inf_schedule]@fiscal_year = N'2022',@period = 1,@inf_date = N'20220509',@inf_time = N'230000'

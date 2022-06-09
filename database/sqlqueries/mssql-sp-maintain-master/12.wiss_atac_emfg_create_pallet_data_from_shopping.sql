USE [ATAC_ARISA_P02]
GO
/****** Object:  StoredProcedure [dbo].[wiss_atac_emfg_create_pallet_data_from_shopping]    Script Date: 27/05/2022 9:52:06 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_atac_emfg_create_pallet_data_from_shopping]
-- Created by : Nuttawut
-- Created date : 26-05-2022
-- Updated date : 26-05-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_atac_emfg_create_pallet_data_from_shopping]
 @picking_list_num as varchar(25) ='',
 @pallet_Number as varchar(25) =''
AS
BEGIN TRY

SET NOCOUNT ON;

DECLARE @USERNAME VARCHAR(100)
DECLARE @KANBANNORMALRID INT
DECLARE @MESSAGE VARCHAR(1024)      =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'
DECLARE @COUNTID INT =0

--SELECT @KAMBAMTMPID =GBTTKANBANHRID ,  @pallet_Number =COMMENT2  FROM GBTTKANBANH WHERE PRODPLANNUM =@picking_list_num AND  COMMENT2 = @pallet_Number and KANBANTYPECODE='07'

--SELECT TOP(1) A.* FROM GBTTKANBANH AS A LEFT OUTER JOIN LCTTPALLETH AS B ON A.GBTTKANBANHRID = B.GBTTKANBANHRID WHERE  KANBANTYPECODE ='07'
--AND B.LCTTPALLETHRID IS NULL
--AND A.PRODPLANNUM =@picking_list_num AND  A.COMMENT2 = @pallet_Number and A.KANBANTYPECODE='07'



SELECT @KANBANNORMALRID =A.GBTTKANBANHRID  , @pallet_Number =A.COMMENT2 FROM GBTTKANBANH AS A LEFT OUTER JOIN LCTTPALLETH AS B ON A.GBTTKANBANHRID = B.GBTTKANBANHRID WHERE  KANBANTYPECODE ='07'
AND B.LCTTPALLETHRID IS NULL
AND A.PRODPLANNUM =@picking_list_num AND  A.COMMENT2 = @pallet_Number and A.KANBANTYPECODE='07'

 IF @KANBANNORMALRID is null
   begin
         	SET @MESSAGE ='Have no pickinglist no:'+ @picking_list_num +' and  pallet no :'+ @picking_list_num +' , please check!!!'
			SET @SPSTATUS ='false'
			SELECT @SPSTATUS AS status, @MESSAGE AS message;
   return
   end


BEGIN TRAN

---------------
DECLARE @RETURN_VALUE INT
DECLARE @STATUS VARCHAR(20) =''
---------------
DECLARE @RESULT_EXEC TABLE ([STATUS] varchar(50))
PRINT 'EXECURE'
INSERT INTO @RESULT_EXEC
EXEC	@RETURN_VALUE = [DBO].[STICSETCREATEPALLETFROMPICKINGLISTANDKANBAN]
		@_USERNAME = N'ADMIN',
		@_PICKINGNUM = @picking_list_num,
		@_PALLETCODE = @pallet_Number,
		@_LOCCODE = N'ATMAPKP',
		@_PLANECODE = N'PL99999999',
		@_GBTTKANBANHRID = @KANBANNORMALRID
		PRINT 'SELECT RESULT '
		--select * from @RESULT_EXEC
COMMIT TRAN
 SELECT @STATUS = STATUS FROM @RESULT_EXEC
 PRINT @STATUS
 SELECT TOP(1) @COUNTID = COUNT(*)  FROM LCTTPALLETH WHERE GBTTKANBANHRID =@KANBANNORMALRID AND PALLETCODE = @pallet_Number
 IF @@ROWCOUNT >0

	BEGIN
	      	--==================      Return      =======================
			SET @MESSAGE ='Create pallet shopping data form pickinglist no:'+ @picking_list_num +' and  pallet no :'+ @picking_list_num +'  has  completed.'
			SET @SPSTATUS ='true'
	END
ELSE
    BEGIN
	    	--==================      Return      =======================
			SET @MESSAGE ='Error : Create pallet shopping data form pickinglist no:'+ @picking_list_num +' and  pallet no :'+ @picking_list_num +'  has not completed.'
			SET @SPSTATUS ='false'
	END



			SELECT @SPSTATUS AS status, @MESSAGE AS message;
END TRY
BEGIN CATCH

 IF @@TRANCOUNT > 0 ROLLBACK;
 PRINT 'ROLE BACK'
		   	SET @SPSTATUS ='false'

	        SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
 END CATCH

 --EXEC	@return_value = [dbo].[[wiss_atac_emfg_create_pallet_data_from_shopping]] @picking_list_num = N'P325A567860', @pallet_Number = N'R008-0|00|20200822'




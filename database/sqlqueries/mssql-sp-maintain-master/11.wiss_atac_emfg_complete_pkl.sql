USE [ATAC_ARISA_P02]
GO
/****** Object:  StoredProcedure [dbo].[wiss_atac_emfg_complete_pkl]    Script Date: 27/05/2022 9:51:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =========================================================
-- [wiss_atac_emfg_add_model]
-- Created by : Nuttawut
-- Created date : 28-03-2022
-- Updated date : 28-03-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_atac_emfg_complete_pkl]
 @picking_list_num as varchar(25) ='',
 @pallet_Number as varchar(25) =''
AS
BEGIN TRY
DECLARE @KAMBAMTMPID INT
DECLARE @USERNAME VARCHAR(100)
DECLARE @KANBANNORMALRID INT =0
DECLARE @MESSAGE VARCHAR(1024)      =''
DECLARE @SPSTATUS VARCHAR(10)       ='false'
DECLARE @resultTable TABLE ([RESULT] varchar(100))
DECLARE @countResult int =0
SET NOCOUNT ON


SELECT @KAMBAMTMPID =GBTTKANBTPHRID ,  @pallet_Number =COMMENT2  FROM GBTTKANBTPH WHERE PRODPLANNUM =@picking_list_num and KANBANTYPECODE ='07'
BEGIN TRAN
	INSERT INTO  @resultTable
	EXEC	@KANBANNORMALRID = [DBO].[STICSETCREATENORMALKANBANFROMTMPKANBAN]
			@_USERNAME = N'ADMIN',
			@_GBTTKANBTPHRID = @KAMBAMTMPID
			SELECT @countResult = count(*) FROM @resultTable where RESULT is not null
	IF (@KANBANNORMALRID =0  or @countResult =0)
		BEGIN
				SET @MESSAGE ='Error : can not complete pickinglist :'+ @picking_list_num +'.'
			    SET @SPSTATUS ='false'

			    SELECT @SPSTATUS AS status, @MESSAGE AS message;
				IF @@TRANCOUNT > 0 ROLLBACK;
				RETURN 0
		END

---------------
DECLARE @RETURN_VALUE INT
---------------
DELETE @resultTable
INSERT INTO  @resultTable
EXEC	@RETURN_VALUE = [DBO].[STICSETCREATEPALLETFROMPICKINGLISTANDKANBAN]
		@_USERNAME = N'ADMIN',
		@_PICKINGNUM = @picking_list_num,
		@_PALLETCODE = @pallet_Number,
		@_LOCCODE = N'ATMAPKP',
		@_PLANECODE = N'PL99999999',
		@_GBTTKANBANHRID = @KANBANNORMALRID

		--SELECT @RETURN_VALUE
	IF @RETURN_VALUE IS NULL
		BEGIN
				SET @MESSAGE ='Error : can not complete pickinglist :'+ @picking_list_num +'.'
			    SET @SPSTATUS ='false'

			    SELECT @SPSTATUS AS status, @MESSAGE AS message;
				RETURN 0
		END


COMMIT TRAN
			--==================      Return      =======================
			SET @MESSAGE =''+ @picking_list_num +'  has successfully completed.'
			SET @SPSTATUS ='true'

			SELECT @SPSTATUS AS status, @MESSAGE AS message;
END TRY
BEGIN CATCH
 IF @@TRANCOUNT > 0 ROLLBACK;
		PRINT 'CASH'
		   	SET @SPSTATUS ='false'
			select ''
	        SELECT @SPSTATUS AS status, ERROR_MESSAGE() AS message
 END CATCH

 --EXEC	@return_value = [dbo].[wiss_atac_emfg_complete_pkl] @picking_list_num = N'P325A567860', @pallet_Number = N'R008-0|00|20200822'




USE [SIAM_EPSDB]
GO
/****** Object:  StoredProcedure [dbo].[wiss_sa_add_eps_investment]    Script Date: 3/11/2022 1:21:27 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =========================================================
-- Created by : Suchart Su
-- Created date : 10-03-2022
-- UPDATEd date : 03-11-2022
-- =========================================================
ALTER PROCEDURE [dbo].[wiss_sa_add_eps_investment]
@investment_id varchar(20)
WITH EXEC AS CALLER
AS
BEGIN
    SET NOCOUNT ON;
-- =========================================================
-- DECARE VARAIBLE
-- =========================================================
    DECLARE @isinsert       bit		            = 0
    DECLARE	@createdate		VARCHAR(8)			= CONVERT (VARCHAR (8), GETDATE (), 112)
  	DECLARE	@createtime		VARCHAR(6)			= REPLACE(CONVERT(VARCHAR(8),GETDATE(),108), ':','')
    DECLARE @message        VARCHAR(255)		= ''
    DECLARE @status         VARCHAR(5)		    = 'false'
	DECLARE @rowid          int                 = 0

-- =========================================================
-- GET INVESTMENT
-- =========================================================
SELECT @rowid = PRFORM_LINE_ROWID FROM TT_PRFORM_LINE where INVESTMENTID = @investment_id AND PRNUM = 'PR00000002'

-- =========================================================
-- FOUND INVESTMENT ID
-- =========================================================
IF @@ROWCOUNT = 0

  BEGIN
    INSERT INTO TT_PRFORM_LINE  VALUES (
       'PR00000002'  -- PRNUM - varchar(255)
      ,1   -- ITEMNO - int
      ,'N'  -- MATID - varchar(255)
      ,@investment_id  -- MATDESC - varchar(255)
      ,'' -- EXPENSEID - varchar(255)
      ,@investment_id -- INVESTMENTID - varchar(255)
      ,'' -- PRODUCTID - varchar(255)
      ,'' -- PRODUCTDESC - varchar(255)
      ,'' -- PRODUCTLINEID - varchar(255)
      ,'' -- PRODUCTLINEDESC - varchar(255)
      ,'' -- MACHINEID - varchar(255)
      ,'' -- MACHINEDESC - varchar(255)
      ,''  -- REQUIREDDATE - varchar(8)
      ,'' -- SHIPTO - varchar(255)
      ,0   -- QTY - numeric(18, 4)
      ,0   -- PRICE - numeric(18, 4)
      ,''  -- UNIT - varchar(255)
      ,0   -- AMOUNT - numeric(18, 4)
      ,'' -- REMARK - varchar(255)
      ,''-- PRFROM_FILE_ID1 - varchar(255)
      ,'' -- PRFROM_FILE_ID2 - varchar(255)
      ,'' -- PRFROM_FILE_ID3 - varchar(255)
      ,''  -- DESCRIPTION - varchar(255)
      ,'ISSUE'  -- STATUS - varchar(255)
      ,'ADMIN'  -- CREATEDBY - varchar(255)
      ,@createdate
      ,@createtime
      ,'ADMIN'  -- EDITEDBY - varchar(255)
      ,@createdate
      ,@createtime
      ,''  -- ENABLED - varchar(255)
      ,'' -- COMMENT1 - varchar(255)
      ,'' -- COMMENT2 - varchar(255)
      ,'' -- COMMENT3 - varchar(255)
      ,'' -- COMMENT4 - varchar(255)
      ,'' -- COMMENT5 - varchar(255)
      ,0 -- NUMERIC1 - numeric(18, 4)
      ,0 -- NUMERIC2 - numeric(18, 4)
      ,'' -- TEXT1 - varchar(1023)
      ,'' -- TEXT2 - varchar(1023)
      ,'' -- GOODSTYPE - varchar(255)
      ,0 -- SERVICEDURATION - DECIMAL(18,4)
      ,'' -- SERVICESTARTDATE - varchar(8)
    )
    SET @isinsert =  1
--    RETURN SCOPE_IDENTITY()

  END
 -- =========================================================
-- NOT FOUND INVESTMENT ID
-- =========================================================

-- =========================================================
-- PREPARE RETURN MESSAGE
-- =========================================================
    IF @isinsert = 1 BEGIN
        SET @message = 'Insert success. Investment ID: '  + @investment_id
        SET @status = 'true'
    END
    ELSE
    BEGIN
        SET @message = 'Insert error because not found Investment ID: '  + @investment_id
        SET @status = 'false'
    END
-- =========================================================
-- RETURN OUTPUT
-- =========================================================
    SELECT @status AS status, @message AS message;

END


-- EXEC wiss_sa_add_eps_investment S21PE064AS01

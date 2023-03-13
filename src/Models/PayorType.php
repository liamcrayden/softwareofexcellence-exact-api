<?php

namespace Crayden\SoftwareOfExcellenceExactAPI\Models;

class PayorType
{
    private $value;

    public function __construct($payor_type)
    {
        switch ($payor_type)
        {
            case 'Private':
            case 'AnyOtherPayor':
            case 'HealthDept':
            case 'Gmhba':
            case 'Ctt':
            case 'Acc':
            case 'NhsEngland':
            case 'Inami':
            case 'HealthDeptSdb':
            case 'NhsScotland':
            case 'Midland':
            case 'MidlandEssentialDental':
            case 'SouthernEssentialDental':
            case 'NorthernCapPlans':
            case 'SouthernEssentialDental2':
            case 'PfsEhh':
            case 'PdsGeneric':
            case 'ShelloitBrunei':
            case 'PdsSeftonV5':
            case 'NorthHealthAdult':
            case 'SadsEds':
            case 'SadsGds':
            case 'PdsCornwall':
            case 'Prsi':
            case 'Gms':
            case 'CapitationPlan':
            case 'NhsIsleOfMan':
            case 'PdsStHelens':
            case 'PdsLeasowe':
            case 'PdsRockferry':
            case 'PdsSefton':
            case 'NhsNorthernIreland':
            case 'PdsWolverhampton':
            case 'PdsBromley':
            case 'PdsGloucestershire':
            case 'PdsWorcestershire':
            case 'PdsNorthampton':
            case 'PdsShropshire':
            case 'PdsSouthernDerbyshire':
            case 'PdsWiltshire':
            case 'PdsPeterborough':
            case 'NhsWales':
            case 'PdsKirkby':
            case 'PdsCustom':
            case 'HealthDeptAohs':
            case 'Denplan':
            case 'PrsiLow':
            case 'PrsiHigh':
            case 'Ohsa':
            case 'Sds':
            case 'OhsExCirc':
            case 'MedicareEasyclaim':
            case 'HicapsWorkSafe':
                $this->value = $payor_type;
                break;
            default:
                $this->value = 'Unknown';
                break;
        }
    }
    
    public function __toString()
    {
        return $this->value;
    }
    
    public function getValue()
    {
        return $this->value;
    }

    public function isNHS()
    {
        switch ($this->value)
        {
            case 'NhsEngland':
            case 'NhsNorthernIreland':
            case 'NhsScotland':
            case 'NhsWales':
            case 'NhsIsleOfMan': 
                return TRUE;
                break;
            default:
                return FALSE;
                break;
        }
    }
}
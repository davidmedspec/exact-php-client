<?php namespace Picqer\Financials\Exact;

/**
 * Class SalesOrder
 *
 * @package Picqer\Financials\Exact
 * @see https://start.exactonline.nl/docs/HlpRestAPIResourcesDetails.aspx?name=salesorderSalesOrders
 *
 * @property Guid $OrderID Primary key
 * @property Double $AmountDC For the header lines (LineNumber = 0) of an entry this is the SUM(AmountDC) of all lines
 * @property Double $AmountFC For the header this is the sum of all lines, including VAT
 * @property DateTime $Created Creation date
 * @property Guid $Creator User ID of creator
 * @property String $CreatorFullName Name of creator
 * @property String $Currency Currency for the order. Default this is the currency of the administration
 * @property String $Description Description. Can be different for header and lines
 * @property Int32 $Division Division code
 * @property Guid $Document Document that is manually linked to the order
 * @property Int32 $DocumentNumber Number of the document
 * @property String $DocumentSubject Subject of the document
 * @property DateTime $DueDate The due date for payments. This date is calculated based on the EntryDate and the Paymentcondition
 * @property DateTime $OrderDate Official date for the order. When the order is entered it's equal to the field 'EntryDate'. During the printing process the order date can be entered
 * @property Int32 $OrderNumber Assigned at entry or at printing depending on setting. The number assigned is based on the freenumbers as defined for the Journal. When printing the field OrderNumber is copied to the fields EntryNumber and OrderNumber of the sales entry
 * @property Guid $OrderTo Reference to the Customer who will receive the order
 * @property Guid $OrderToContactPerson Reference to the Contact person of the customer who will receive the order
 * @property String $OrderToContactPersonFullName Name of the contact person of the customer who will receive the order
 * @property String $OrderToName Name of the customer who will receive the order
 * @property Int32 $Journal Assigned at entry or at printing depending on setting. The number assigned is based on the freenumbers as defined for the Journal. When printing the field OrderNumber is copied to the fields EntryNumber and OrderNumber of the sales entry
 * @property String $JournalDescription Description of Journal
 * @property DateTime $Modified Last modified date
 * @property Guid $Modifier User ID of modifier
 * @property String $ModifierFullName Name of modifier
 * @property DateTime $OrderDate Order date
 * @property Guid $OrderedBy Customer who ordered the order
 * @property Guid $OrderedByContactPerson Contact person of customer who ordered the order
 * @property String $OrderedByContactPersonFullName Name of contact person of customer who ordered the order
 * @property String $OrderedByName Name of customer who ordered the order
 * @property Int32 $OrderNumber Number to identify the order. By default the number is based on a setting for the first free number, but you can post your own number.
 * @property DateTime $PaymentCondition The due date for payments. This date is calculated based on the EntryDate and the Paymentcondition
 * @property String $PaymentConditionDescription Description of PaymentCondition
 * @property String $Remarks Extra remarks
 * @property SalesOrderLines $SalesOrderLines Collection of lines
 * @property Guid $Salesperson Sales representative
 * @property String $SalespersonFullName Name of sales representative
 * @property Int16 $StarterSalesOrderStatus Starter Sales order status (for starter functionality)
 * @property String $StarterSalesOrderStatusDescription Description of StarterSalesOrderStatus
 * @property Int16 $Status Starter Sales order status (for starter functionality)
 * @property String $StatusDescription Description of StarterSalesOrderStatus
 * @property Guid $TaxSchedule Tax schedule linked
 * @property String $TaxScheduleCode Code of the tax schedule
 * @property String $TaxScheduleDescription Description of the tax schedule
 * @property Int32 $Type Indicates the type of order Values: 8020 - Sales orders, 8021 - Sales credit note
 * @property String $TypeDescription Description of the type
 * @property Double $VATAmountDC Total VAT amount in the default currency of the company
 * @property Double $VATAmountFC Total VAT amount in the currency of the transaction
 * @property String $YourRef The order number of the customer
 */
class SalesOrder extends Model
{

    use Query\Findable;
    use Persistance\Storable;

    protected $primaryKey = 'OrderID';

    protected $fillable = [
    'OrderID',
    'AmountDC',
    'AmountFC',
    'Created',
    'Creator',
    'CreatorFullName',
    'Currency',
    'Description',
    'Division',
    'Document',
    'DocumentNumber',
    'DocumentSubject',
    'DueDate',
    'OrderDate',
    'OrderNumber',
    'OrderTo',
    'OrderToContactPerson',
    'OrderToContactPersonFullName',
    'DeliverTo',
    'DeliverToContactPerson',
    'DeliveryAddress',
    'OrderToName',
    'Journal',
    'JournalDescription',
    'Modified',
    'Modifier',
    'ModifierFullName',
    'OrderDate',
    'OrderedBy',
    'OrderedByContactPerson',
    'OrderedByContactPersonFullName',
    'OrderedByName',
    'OrderNumber',
    'PaymentCondition',
    'PaymentConditionDescription',
    'Remarks',
    'SalesOrderLines',
    'Salesperson',
    'SalespersonFullName',
    'StarterSalesOrderStatus',
    'StarterSalesOrderStatusDescription',
    'Status',
    'StatusDescription',
    'TaxSchedule',
    'TaxScheduleCode',
    'TaxScheduleDescription',
    'Type',
    'TypeDescription',
    'VATAmountDC',
    'VATAmountFC',
    'YourRef',
    'WarehouseCode',
    'WarehouseDescription',
    'WarehouseID'
    ];

    protected $url = 'salesorder/SalesOrders';

    /**
     * Updates the SalesOrderLines collection on a SalesOrder if it's been detected as a deferred collection.
     * Fetches results and stores them on this object.
     *
     * @return mixed
     */
    public function getSalesOrderLines() {
        if(array_key_exists('__deferred', $this->attributes['SalesOrderLines'])) {
            $this->attributes['SalesOrderLines'] = (new SalesOrderLine($this->connection()))->filter("OrderID eq guid'{$this->OrderID}'");
        }
        return $this->attributes['SalesOrderLines'];
    }

}

<?php
namespace Ahromets\Testimonials\Model\ResourceModel\Testimonial;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Ahromets\Testimonials\Model\Testimonial', 'Ahromets\Testimonials\Model\ResourceModel\Testimonial');
    }

}
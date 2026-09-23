<?php
namespace TacticalExpressions\Core\Observer;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
# 2026-09-23
# «We are now seeing filter URLs appearing in Google’s index»:
# https://github.com/tactical-expressions/core/issues/1 -->
final class LayoutGenerateBlocksAfter implements ObserverInterface {
	/**
	 * 2026-09-23
	 * @override
	 * @see ObserverInterface::execute()
	 * @see \Magento\Framework\View\Layout\Builder::loadLayoutUpdates():
	 * 		$this->eventManager->dispatch(
	 * 			'layout_load_before',
	 * 			['full_action_name' => $this->request->getFullActionName(), 'layout' => $this->layout]
	 * 		);
	 * https://github.com/magento/magento2/blob/2.4.4/lib/internal/Magento/Framework/View/Layout/Builder.php#L79-L82
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 */
	function execute(O $o):void {
		if (df_is_catalog_search_result() || df_is_catalog_product_list_filtered()) {
			df_robots_no_index();
		}
	}
}
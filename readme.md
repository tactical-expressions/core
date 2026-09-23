A custom module for [tactical-expressions.com](https://tactical-expressions.com) (Magento 2).  

## How to install
```bash             
(
	bin/magento maintenance:enable
	composer require tactical-expressions/core:* --ignore-platform-req=ext-ftp
	rm -rf var/di var/generation generated/*
	bin/magento setup:upgrade
	bin/magento cache:enable
	bin/magento setup:di:compile	
)
(
	bin/magento cache:clean
	(
		o=(
			pub/static/*		
			var/cache
			var/page_cache
			var/view_preprocessed
		) 
		rm -rf "${o[@]}"
	)
	(
		ll='en_US'
		tt=(
			'adminhtml Magento/backend'
			'frontend Codazon/unlimited_supermarket'
		)	
		for t in "${tt[@]}"; do
			read -r area theme <<< "$t"
			o=(
				--area $area
				--force
				--theme $theme
			)
			bin/magento setup:static-content:deploy "${o[@]}" $ll
		done
	)
	bin/magento cache:clean	
)	
bin/magento maintenance:disable
```

## How to upgrade
```bash     
(
	bin/magento maintenance:enable
	composer remove tactical-expressions/core --ignore-platform-req=ext-ftp
	composer require tactical-expressions/core:* --ignore-platform-req=ext-ftp
	rm -rf var/di var/generation generated/*
	bin/magento setup:upgrade
	bin/magento cache:enable
	bin/magento setup:di:compile	
)
(
	bin/magento cache:clean
	(
		o=(
			pub/static/*		
			var/cache
			var/page_cache
			var/view_preprocessed
		) 
		rm -rf "${o[@]}"
	)
	(
		ll='en_US'
		tt=(
			'adminhtml Magento/backend'
			'frontend Codazon/unlimited_supermarket'
		)	
		for t in "${tt[@]}"; do
			read -r area theme <<< "$t"
			o=(
				--area $area
				--force
				--theme $theme
			)
			bin/magento setup:static-content:deploy "${o[@]}" $ll
		done
	)
	bin/magento cache:clean	
)	
bin/magento maintenance:disable
```
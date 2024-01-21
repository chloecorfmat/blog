.PHONY: wp-build-local
wp-build-local:
	ansible-playbook wp-build.yml -i inventories/local.yml -e "tag=main"

.PHONY: wp-deploy-local
wp-deploy-local:
	ansible-playbook wp-deploy.yml -i inventories/local.yml -e "tag=main"

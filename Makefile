# Makefile

.PHONY: h ih cc

# Command to display the list of available commands
h:
	@echo "Available commands:"
	@echo "  ih      - Generate IDE helper files (models, facades, meta)"
	@echo "  cc      - Clear cache (cache, config, route, view) and update autoload"
	@echo "  shield  - Generate permissions/policies"
	@echo "  h       - Show the list of available commands"

# Command to generate permissions/policies
shield:
	php artisan shield:generate --all

# ide-helper Command to generate helper files for models, facades, and metadata
ih:
	php artisan ide-helper:generate
	php artisan ide-helper:models --write
	php artisan ide-helper:meta

# cache clear Command to clear caches and update Composer autoload
cc:
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	php artisan view:clear
	php artisan filament:clear-cached-components
	php artisan filament:optimize-clear
	composer dump-autoload

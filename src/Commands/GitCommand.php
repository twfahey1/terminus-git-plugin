<?php
/**
 * This command will run git commands on a Pantheon site.
 *
 * See README.md for usage information.
 */

namespace Pantheon\TerminusGit\Commands;

use Consolidation\OutputFormatters\StructuredData\PropertyList;
use Pantheon\Terminus\Commands\TerminusCommand;
use Pantheon\Terminus\Exceptions\TerminusException;
use Pantheon\Terminus\Site\SiteAwareInterface;
use Pantheon\Terminus\Site\SiteAwareTrait;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Run git commands on a Pantheon instance
 */
class GitCommand extends TerminusCommand implements SiteAwareInterface
{
    use SiteAwareTrait;

    protected $info;
    protected $tmpDirs = [];

    /**
     * Object constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Call git clone on a Pantheon site
     *
     * @command git:clone
     * @aliases gc
     *
     * @param string $site_env_id Source site to clone
     * @param string $dest Destination path
     * @param array $rsyncOptions All of the options after -- (passed to rsync)
     */
    public function gitCloneCommand($site_env_id, $dest, $rsyncOptions = NULL)
    {
        list($site, $env) = $this->getSiteEnv($site_env_id);
        $env_id = $env->getName();
        $siteInfo = $site->serialize();
        $site_id = $siteInfo['id'];
        $repo_path = "ssh://codeserver.dev.$site_id@codeserver.dev.$site_id.drush.in:2222/~/repository.git";
        $this->passthru("git clone $repo_path $dest");
    }

    protected function passthru($command)
    {
        $result = 0;
        passthru($command, $result);

        if ($result != 0) {
            throw new TerminusException('Command `{command}` failed with exit code {status}', ['command' => $command, 'status' => $result]);
        }
    }

}
